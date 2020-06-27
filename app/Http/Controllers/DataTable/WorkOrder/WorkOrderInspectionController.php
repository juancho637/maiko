<?php

namespace App\Http\Controllers\DataTable\WorkOrder;

use App\WorkOrder;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class WorkOrderInspectionController extends Controller
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
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function index(WorkOrder $work_order)
    {
        return DataTables::of($work_order->inspections()->with(
                'status:id,name',
                'user:id,full_name',
                'tank:id,internal_serial_number'
            ))
            ->addColumn('actions', 'dashboard.work_orders.inspections.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
