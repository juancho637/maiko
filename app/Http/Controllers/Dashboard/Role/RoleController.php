<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view roles')->only('index');
        $this->middleware('can:view role')->only('show');
        $this->middleware('can:create roles')->only(['create', 'store']);
        $this->middleware('can:edit roles')->only(['edit', 'update']);
        $this->middleware('can:delete roles')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionsByModule = Permission::all()->groupBy('module');

        return view('dashboard.roles.create', compact('permissionsByModule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:roles,name',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,name',
        ]);

        Role::create([
            'name' => $request->name
        ])->givePermissionTo($request->permissions);

        return redirect()->route('dashboard.roles.index')->with('success', 'Rol creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissionsByModule = Permission::all()->groupBy('module');

        return view('dashboard.roles.show', compact('role', 'permissionsByModule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissionsByModule = Permission::all()->groupBy('module');

        return view('dashboard.roles.edit', compact('role', 'permissionsByModule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:roles,name,'.$role->id,
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'exists:permissions,name',
        ]);

        if (in_array($role->name, ['super administrator'])) {
            return redirect()->route('dashboard.roles.edit', $role)->with('error', 'Este rol no puede ser actualizado');
        }

        $role->update($request->all());

        $role->syncPermissions($request->permissions);

        return redirect()->route('dashboard.roles.show', $role)->with('success', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (!in_array($role->name, ['super administrator', 'inspector'])) {
            if ($role->revokePermissionTo($role->getAllPermissions())){
                if ($role->delete()){
                    return redirect()->route('dashboard.roles.index')->with('success', 'Rol eliminado correctamente');
                }
            }
        }

        return redirect()->route('dashboard.roles.index')->with('error', 'Este rol no puede ser eliminado');
    }
}
