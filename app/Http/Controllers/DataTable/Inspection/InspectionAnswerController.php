<?php

namespace App\Http\Controllers\DataTable\Inspection;

use App\Inspection;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class InspectionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Inspection $inspection)
    {
        return DataTables::of($inspection->answers()
            ->select(['id', 'value', 'question_id'])->with(
                'question:id,question',
            )->get())
            // ->addColumn('actions', 'dashboard.work_orders.inspections.partials.actions')
            // ->rawColumns(['actions'])
            ->toJson();
    }
}
