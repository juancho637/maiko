<?php

namespace App\Http\Controllers\DataTable\Company;

use App\Company;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CompanyClientController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view clients')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        return DataTables::of($company->clients())
            ->addColumn('actions', 'dashboard.companies.clients.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
