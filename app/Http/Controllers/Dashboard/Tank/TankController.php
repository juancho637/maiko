<?php

namespace App\Http\Controllers\Dashboard\Tank;

use App\Tank;
use App\Client;
use App\Status;
use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TankController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view tanks')->only('index');
        $this->middleware('can:view tank')->only('show');
        $this->middleware('can:create tanks')->only(['create', 'store']);
        $this->middleware('can:edit tanks')->only(['edit', 'update']);
        $this->middleware('can:delete tanks')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.tanks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::get(['id', 'name']);

        return view('dashboard.tanks.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now()->toDateString();

        $this->validate($request, [
            'company_id' => 'required|exists:companies,id',
            'client_id' => ['required', 'exists:clients,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) Client::where('id', $value)->first()->company_id !== $request['company_id']) {
                    $fail($attribute.' no pertenece a la empresa seleccionado.');
                }
            }],
            'internal_serial_number' => 'required|string|max:191',
            'serial_number' => 'required|string|max:191',
            'maker' => 'required|string|max:191',
            'fabrication_year' => 'required|date|before:'.$now,
            'capacity' => 'required|string|max:191',
            'large' => 'required|string|max:191',
            'diameter' => 'required|string|max:191',
            'head_thickness' => 'required|string|max:191',
            'body_thickness' => 'required|string|max:191',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        Tank::create($request->all());

        return redirect()->route('dashboard.tanks.index')->with('success', __(":model creado correctamente", ['model' => ucfirst(__('tanque'))]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function show(Tank $tank)
    {
        return view('dashboard.tanks.show', compact('tank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function edit(Tank $tank)
    {
        $companies = Company::get(['id', 'name']);

        return view('dashboard.tanks.edit', compact('companies', 'tank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tank $tank)
    {
        $now = Carbon::now()->toDateString();

        $this->validate($request, [
            'company_id' => 'required|exists:companies,id',
            'client_id' => ['required', 'exists:clients,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) Client::where('id', $value)->first()->company_id !== $request['company_id']) {
                    $fail($attribute.' no pertenece a la empresa seleccionado.');
                }
            }],
            'internal_serial_number' => 'required|string|max:191',
            'serial_number' => 'required|string|max:191',
            'maker' => 'required|string|max:191',
            'fabrication_year' => 'required|date|before:'.$now,
            'capacity' => 'required|string|max:191',
            'large' => 'required|string|max:191',
            'diameter' => 'required|string|max:191',
            'head_thickness' => 'required|string|max:191',
            'body_thickness' => 'required|string|max:191',
        ]);

        $tank->update($request->all());

        return redirect()->route('dashboard.tanks.show', $tank)->with('success', __(":model actualizado correctamente", ['model' => ucfirst(__('tanque'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tank $tank)
    {
        if($tank->delete()) {
            return redirect()->route('dashboard.tanks.index')->with('success', __(":model eliminado correctamente", ['model' => ucfirst(__('tanque'))]));
        }
    }
}
