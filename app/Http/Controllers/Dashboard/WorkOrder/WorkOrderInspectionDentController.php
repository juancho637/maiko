<?php

namespace App\Http\Controllers\Dashboard\WorkOrder;

use App\Dent;
use App\WorkOrder;
use App\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkOrderInspectionDentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $work_order, Inspection $inspection, Dent $dent)
    {
        return view('dashboard.dents.show', compact('work_order', 'inspection', 'dent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $work_order, Inspection $inspection, Dent $dent)
    {
        return view('dashboard.dents.edit', compact('work_order', 'inspection', 'dent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOrder $work_order, Inspection $inspection, Dent $dent)
    {
        $this->validate($request, [
            'large' => 'required|string',
            'width' => 'required|string',
            'average' => 'required|string',
            'observation' => 'string',
        ]);

        $dent->update($request->all());

        return redirect()->route('dashboard.work_orders.inspections.dents.show', [$work_order, $inspection, $dent])->with('success', __(":model actualizada correctamente", ['model' => ucfirst(__('abolladura'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder $work_order, Inspection $inspection, Dent $dent)
    {
        if ($dent->delete()) {
            return redirect()->route('dashboard.work_orders.inspections.show', [$work_order, $inspection])->with('success', __(":model eliminada correctamente", ['model' => ucfirst(__('abolladura'))]));
        }
    }
}
