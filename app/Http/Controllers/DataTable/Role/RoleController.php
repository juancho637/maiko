<?php

namespace App\Http\Controllers\DataTable\Role;

use App\Role;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view roles')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(Role::query())
            ->addColumn('actions', 'dashboard.roles.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
