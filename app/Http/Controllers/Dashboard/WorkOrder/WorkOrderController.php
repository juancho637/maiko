<?php

namespace App\Http\Controllers\Dashboard\WorkOrder;

use App\City;
use App\User;
use App\State;
use App\Status;
use App\Company;
use App\Country;
use App\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkOrderController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view work orders')->only('index');
        $this->middleware('can:view work order')->only('show');
        $this->middleware('can:create work orders')->only(['create', 'store']);
        $this->middleware('can:edit work orders')->only(['edit', 'update']);
        $this->middleware('can:delete work orders')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.work_orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::get(['id', 'name']);
        $countries = Country::all('id', 'name');
        $users = User::role('inspector')->get(['id', 'full_name']);

        return view('dashboard.work_orders.create', compact('companies', 'countries', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_id' => 'required|exists:companies,id',
            'quotation' => 'required|string|max:191',
            'start' => 'required|date|after_or_equal:'.now()->toDateString('Y-m-d'),
            'work_order_number' => 'required|unique:work_orders,work_order_number|string|max:191',
            'address' => 'required|string|max:191',
            'country_id' => 'required|exists:countries,id',
            'state_id' => ['required', 'exists:states,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) State::where('id', $value)->first()->country_id !== $request['country_id']) {
                    $fail($attribute.' no pertenece a al país seleccionado.');
                }
            }],
            'city_id' => ['required', 'exists:cities,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) City::where('id', $value)->first()->state_id !== $request['state_id']) {
                    $fail($attribute.' no pertenece a el estado/departamento seleccionado.');
                }
            }],
            'contact_name' => 'required|string|max:191',
            'contact_number' => 'required|string|max:191',
            'users' => 'required|array|min:1',
            'users.*' => 'exists:users,id',
            'certificate_name' => 'required|string|max:191',
            'owner_email' => 'required|string|max:191',
            'emails' => 'required|string|max:191',
            'r_mkc_002' => 'boolean',
            'r_mkc_031' => 'boolean',
            'r_mkc_032' => 'boolean',
            'r_mkc_033' => 'boolean',
            'r_mkc_045' => 'boolean',
            'r_mkc_046' => 'boolean',
            'r_mkc_090' => 'boolean',
            'tape_measure' => 'boolean',
            'caliper' => 'boolean',
            'multimeter' => 'boolean',
            'videoscopio' => 'boolean',
            'photometer' => 'boolean',
            'thermohygometer' => 'boolean',
            'bridge_cam_gauge' => 'boolean',
            'depth_gauge' => 'boolean',
            'gauge' => 'boolean',
            'thickness_gauge_ex' => 'boolean',
            'reference_block_ladder_ex' => 'boolean',
            'caliper_bagel' => 'boolean',
            'thickness_gauge_in' => 'boolean',
            'reference_block_ladder_in' => 'boolean',
            'thermometer' => 'boolean',
            'gas_multidetector' => 'boolean',
            'harness' => 'boolean',
            'mask' => 'boolean',
            'slings' => 'boolean',
            'lifeline' => 'boolean',
            'atmospheremeter' => 'boolean',
            'observation' => 'required|string|max:191',
            'transport' => 'required|string|max:191',
            'hospitals' => 'required|string|max:191',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        $work_order = WorkOrder::create($request->all());

        $work_order->users()->sync($request->users);

        return redirect()->route('dashboard.work_orders.index')->with('success', __(":model creada correctamente", ['model' => ucfirst(__('orden de trabajo'))]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $work_order)
    {
        return view('dashboard.work_orders.show', compact('work_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $work_order)
    {
        $companies = Company::get(['id', 'name']);
        $countries = Country::all('id', 'name');
        $users = User::role('inspector')->get(['id', 'full_name']);
        $statuses = Status::whereIn('type', ['general', 'work_orders'])->get();

        return view('dashboard.work_orders.edit', compact('work_order', 'companies', 'countries', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOrder $work_order)
    {
        $this->validate($request, [
            'company_id' => 'required|exists:companies,id',
            'quotation' => 'required|string|max:191',
            'start' => ['required', 'date', function ($attribute, $value, $fail) use ($work_order) {
                if($value !== $work_order->start) {
                    if(strtotime($value) < strtotime(now()->toDateString('Y-m-d'))) {
                        $fail($attribute.' debe ser una fecha posterior o igual a '.now()->toDateString('Y-m-d'));
                    }
                }
            }],
            'work_order_number' => 'required|string|max:191|unique:work_orders,work_order_number,'.$work_order->id,
            'address' => 'required|string|max:191',
            'country_id' => 'required|exists:countries,id',
            'state_id' => ['required', 'exists:states,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) State::where('id', $value)->first()->country_id !== $request['country_id']) {
                    $fail($attribute.' no pertenece a al país seleccionado.');
                }
            }],
            'city_id' => ['required', 'exists:cities,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) City::where('id', $value)->first()->state_id !== $request['state_id']) {
                    $fail($attribute.' no pertenece a el estado/departamento seleccionado.');
                }
            }],
            'contact_name' => 'required|string|max:191',
            'contact_number' => 'required|string|max:191',
            'inspectors' => 'required|array|min:1',
            'inspectors.*' => 'exists:users,id',
            'certificate_name' => 'required|string|max:191',
            'owner_email' => 'required|string|max:191',
            'emails' => 'required|string|max:191',
            'r_mkc_002' => 'boolean',
            'r_mkc_031' => 'boolean',
            'r_mkc_032' => 'boolean',
            'r_mkc_033' => 'boolean',
            'r_mkc_045' => 'boolean',
            'r_mkc_046' => 'boolean',
            'r_mkc_090' => 'boolean',
            'tape_measure' => 'boolean',
            'caliper' => 'boolean',
            'multimeter' => 'boolean',
            'videoscopio' => 'boolean',
            'photometer' => 'boolean',
            'thermohygometer' => 'boolean',
            'bridge_cam_gauge' => 'boolean',
            'depth_gauge' => 'boolean',
            'gauge' => 'boolean',
            'thickness_gauge_ex' => 'boolean',
            'reference_block_ladder_ex' => 'boolean',
            'caliper_bagel' => 'boolean',
            'thickness_gauge_in' => 'boolean',
            'reference_block_ladder_in' => 'boolean',
            'thermometer' => 'boolean',
            'gas_multidetector' => 'boolean',
            'harness' => 'boolean',
            'mask' => 'boolean',
            'slings' => 'boolean',
            'lifeline' => 'boolean',
            'atmospheremeter' => 'boolean',
            'observation' => 'required|string|max:191',
            'transport' => 'required|string|max:191',
            'hospitals' => 'required|string|max:191',
        ]);

        $work_order->update($request->all());

        $work_order->users()->sync($request->inspectors);

        return redirect()->route('dashboard.work_orders.show', $work_order)->with('success', __(":model actualizada correctamente", ['model' => ucfirst(__('orden de trabajo'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder $work_order)
    {
        if($work_order->delete()) {
            return redirect()->route('dashboard.work_orders.index')->with('success', __(":model eliminada correctamente", ['model' => ucfirst(__('orden de trabajo'))]));
        }
    }
}
