<?php

namespace App\Http\Controllers\Dashboard\WorkOrder;

use App\Corrosion;
use App\WorkOrder;
use App\Inspection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class WorkOrderInspectionCorrosionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $work_order, Inspection $inspection, Corrosion $corrosion)
    {
        return view('dashboard.corrosions.show', compact('work_order', 'inspection', 'corrosion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $work_order, Inspection $inspection, Corrosion $corrosion)
    {
        $corrosion_types = Corrosion::CORROSION_TYPES;

        return view('dashboard.corrosions.edit', compact('work_order', 'inspection', 'corrosion', 'corrosion_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOrder $work_order, Inspection $inspection, Corrosion $corrosion)
    {
        $this->validate($request, [
            'corrosion_type'  => [
                'required',
                Rule::in(Corrosion::CORROSION_TYPES),
            ],
            'remaining_thickness' => 'required|string',
            'area' => 'required|string',
            'large' => 'required|string',
            'thickness' => 'required|string',
            'depth' => 'required|string',
            'observation' => 'string',
        ]);

        $corrosion->update($request->all());

        return redirect()->route('dashboard.work_orders.inspections.corrosions.show', [$work_order, $inspection, $corrosion])->with('success', __(":model actualizada correctamente", ['model' => ucfirst(__('corrosión'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkOrder  $work_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder $work_order, Inspection $inspection, Corrosion $corrosion)
    {
        if ($corrosion->delete()) {
            return redirect()->route('dashboard.work_orders.inspections.show', [$work_order, $inspection])->with('success', __(":model eliminada correctamente", ['model' => ucfirst(__('corrosión'))]));
        }
    }
}
