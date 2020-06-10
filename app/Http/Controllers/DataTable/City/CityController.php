<?php

namespace App\Http\Controllers\DataTable\City;

use App\City;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view cities')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(City::with('state:id,name'))
            ->editColumn('state.name', function(City $city) {
                return "<a href='".route("dashboard.states.show", $city->state_id)."'>".$city->state->name."</a>";
            })
            ->addColumn('actions', 'dashboard.zones.cities.partials.actions')
            ->rawColumns(['actions', 'state.name'])
            ->toJson();
    }
}
