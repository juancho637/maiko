<?php

namespace App\Http\Controllers\DataTable\User;

use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view users')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(User::all())
            ->addColumn('roles', function (User $user) {
                return $user->roles->map(function($role) {
                    return "<a href='".route("dashboard.roles.show", $role->id)."'>".$role->name."</a>";
                })->implode(', ');
            })
            ->addColumn('actions', 'dashboard.users.partials.actions')
            ->rawColumns(['actions', 'roles'])
            ->toJson();
    }
}
