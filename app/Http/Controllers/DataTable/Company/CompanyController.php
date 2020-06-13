<?php

namespace App\Http\Controllers\DataTable\Company;

use App\Company;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view companies')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(Company::all())
            ->addColumn('actions', 'dashboard.companies.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
