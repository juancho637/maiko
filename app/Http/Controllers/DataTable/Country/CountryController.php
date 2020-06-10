<?php

namespace App\Http\Controllers\DataTable\Country;

use App\Country;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view countries')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(Country::with(['status']))
            ->addColumn('actions', 'dashboard.zones.countries.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
