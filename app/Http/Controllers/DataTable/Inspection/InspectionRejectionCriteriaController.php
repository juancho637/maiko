<?php

namespace App\Http\Controllers\DataTable\Inspection;

use App\Inspection;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class InspectionRejectionCriteriaController extends Controller
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
    public function index(Inspection $inspection)
    {
        return DataTables::of($inspection->rejection_criterias()->get(['id', 'criteria']))
            ->toJson();
    }
}
