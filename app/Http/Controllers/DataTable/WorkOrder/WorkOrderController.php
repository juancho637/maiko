<?php

namespace App\Http\Controllers\DataTable\WorkOrder;

use App\WorkOrder;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class WorkOrderController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view work orders')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(WorkOrder::with('company:id,name', 'status:id,name'))
            ->editColumn('quotation', function(WorkOrder $work_order) {
                return '$'.number_format($work_order->quotation, 0, ',', '.');
            })
            ->addColumn('actions', 'dashboard.work_orders.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
