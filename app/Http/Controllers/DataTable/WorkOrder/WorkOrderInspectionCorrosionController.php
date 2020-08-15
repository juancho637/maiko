<?php

namespace App\Http\Controllers\DataTable\WorkOrder;

use App\Corrosion;
use App\WorkOrder;
use App\Inspection;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class WorkOrderInspectionCorrosionController extends Controller
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
        return DataTables::of($inspection->corrosions()->get(['id', 'inspection_id', 'corrosion_type', 'area']))
            ->editColumn('corrosion_type', function (Corrosion $corrosion) {
                return __($corrosion->corrosion_type);
            })
            ->addColumn('actions', function (Corrosion $corrosion) use ($work_order) {
                $view = route('dashboard.work_orders.inspections.corrosions.show', [$work_order->id, $corrosion->inspection_id, $corrosion->id]);
                $edit = route('dashboard.work_orders.inspections.corrosions.show', [$work_order->id, $corrosion->inspection_id, $corrosion->id]);
                $delete = route('dashboard.work_orders.inspections.corrosions.show', [$work_order->id, $corrosion->inspection_id, $corrosion->id]);

                return view('dashboard.corrosions.partials.actions', compact('view', 'edit', 'delete'));
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
