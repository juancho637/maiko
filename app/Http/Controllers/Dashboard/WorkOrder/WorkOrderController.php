<?php

namespace App\Http\Controllers\Dashboard\WorkOrder;

use App\Status;
use App\Company;
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

        return view('dashboard.work_orders.create', compact('companies'));
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
            'quotation' => 'required|string|max:191',
            'start' => 'required|date|after:'.$now,
            'duration' => 'required|string|max:191',
            'transport' => 'required|string|max:191',
            'feeding' => 'required|string|max:191',
            'hotel' => 'required|string|max:191',
            'lodging' => 'required|string|max:191',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        WorkOrder::create($request->all());

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

        return view('dashboard.work_orders.edit', compact('companies', 'work_order'));
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
        $now = Carbon::now()->toDateString();

        $this->validate($request, [
            'company_id' => 'required|exists:companies,id',
            'quotation' => 'required|string|max:191',
            'start' => 'required|date|after:'.$now,
            'duration' => 'required|string|max:191',
            'transport' => 'required|string|max:191',
            'feeding' => 'required|string|max:191',
            'hotel' => 'required|string|max:191',
            'lodging' => 'required|string|max:191',
        ]);

        $work_order->update($request->all());

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
