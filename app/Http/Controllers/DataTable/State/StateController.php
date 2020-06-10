<?php

namespace App\Http\Controllers\DataTable\State;

use App\State;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view states')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(State::with('country:id,name'))
            ->editColumn('country.name', function(State $state) {
                return "<a href='".route("dashboard.countries.show", $state->country_id)."'>".$state->country->name."</a>";
            })
            ->addColumn('actions', 'dashboard.zones.states.partials.actions')
            ->rawColumns(['actions', 'country.name'])
            ->toJson();
    }
}
