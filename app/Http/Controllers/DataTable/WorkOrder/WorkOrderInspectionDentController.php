<?php

namespace App\Http\Controllers\DataTable\WorkOrder;

use App\Dent;
use App\WorkOrder;
use App\Inspection;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class WorkOrderInspectionDentController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view inspections')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WorkOrder $work_order, Inspection $inspection)
    {
        return DataTables::of($inspection->dents()->get(['id', 'inspection_id', 'large', 'width']))
            ->addColumn('actions', function (Dent $dent) use ($work_order) {
                $view = route('dashboard.work_orders.inspections.dents.show', [$work_order->id, $dent->inspection_id, $dent->id]);
                $edit = route('dashboard.work_orders.inspections.dents.show', [$work_order->id, $dent->inspection_id, $dent->id]);
                $delete = route('dashboard.work_orders.inspections.dents.show', [$work_order->id, $dent->inspection_id, $dent->id]);

                return view('dashboard.dents.partials.actions', compact('view', 'edit', 'delete'));
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
