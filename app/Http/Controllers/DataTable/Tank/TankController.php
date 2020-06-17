<?php

namespace App\Http\Controllers\DataTable\Tank;

use App\Tank;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class TankController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view tanks')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(Tank::with('client.company'))
            ->addColumn('actions', 'dashboard.tanks.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
