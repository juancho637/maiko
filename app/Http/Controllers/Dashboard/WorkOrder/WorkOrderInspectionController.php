<?php

namespace App\Http\Controllers\Dashboard\WorkOrder;

use App\Tank;
use App\User;
use App\Client;
use App\Status;
use App\WorkOrder;
use App\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkOrderInspectionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(WorkOrder $work_order)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, WorkOrder $work_order)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $work_order, Inspection $inspection)
    {
        return view('dashboard.work_orders.inspections.show', compact('work_order', 'inspection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $work_order, Inspection $inspection)
    {
        $users = User::role('inspector')->get();
        $statuses = Status::whereIn('type', ['general', 'inspections'])->get();

        return view('dashboard.work_orders.inspections.edit', compact('work_order', 'inspection', 'users', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOrder $work_order, Inspection $inspection)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'status_id' => 'required|exists:statuses,id',
            'client_id' => ['required', 'exists:clients,id', function ($attribute, $value, $fail) use ($work_order) {
                if ((string)Client::where('id', $value)->first()->company_id !== (string)$work_order->company_id) {
                    $fail($attribute.' no pertenece a la empresa asignada a la orden de trabajo.');
                }
            }],
            'tank_id' => ['required', 'exists:tanks,id', function ($attribute, $value, $fail) use ($request) {
                if ((string)Tank::where('id', $value)->first()->client_id !== (string)$request['client_id']) {
                    $fail($attribute.' no pertenece a el cliente seleccionado.');
                }
            }],
            'light_intensity' => 'string',
            'humidity' => 'string',
            'temperature' => 'string',
            'observation' => 'string',
        ]);

        $client = Client::where('id', $request->client_id)->first();
        $request['city_id'] = $client->city_id;
        $request['address'] = $client->address;

        $inspection->update($request->all());

        return redirect()->route('dashboard.work_orders.inspections.show', [$work_order, $inspection])->with('success', __(":model actualizada correctamente", ['model' => ucfirst(__('inspección'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder $work_order, Inspection $inspection)
    {
        if($inspection->delete()) {
            return redirect()->route('dashboard.work_orders.show', $work_order)->with('success', __(":model eliminada correctamente", ['model' => ucfirst(__('inspección'))]));
        }
    }
}
