<?php

namespace App\Http\Controllers\Dashboard\User;

use App\User;
use App\Role;
use App\Status;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\Dashboard\User\CreationNotification;

class UserController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view users')->only('index');
        $this->middleware('can:view user')->only('show');
        $this->middleware('can:create users')->only(['create', 'store']);
        $this->middleware('can:edit users')->only(['edit', 'update']);
        $this->middleware('can:delete users')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(['name']);

        return view('dashboard.users.create', compact('roles'));
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
            'full_name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,name',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;
        $request['password'] = Hash::make(Str::random(10));
        $request['verification_token'] = User::generate_verification_token();
        $request['accepted_terms'] = 1;

        DB::beginTransaction();
        $user = User::create($request->all());

        $user->syncRoles($request->roles)
            ->notify(new CreationNotification());
        DB::commit();

        return redirect()->route('dashboard.users.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get(['name']);

        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'full_name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.$user->id,
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,name',
        ]);

        DB::beginTransaction();
        $user->update($request->all());

        $user->syncRoles($request->roles);
        DB::commit();

        return redirect()->route('dashboard.users.show', $user)->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        $user->status_id = Status::abbreviation('gen-del')->id;
        $user->email = null;
        $user->password = null;
        $user->email_verified_at = null;
        $user->verification_token = null;
        $user->save();

        $user->delete();
        DB::commit();

        return redirect()->route('dashboard.users.index')->with('success', 'Usuario eliminado correctamente');
    }

    /**
     * Muestra el formulario para la verificación y actualización de contraseña del usuario.
     */
    public function verify_form($token)
    {
        return view('dashboard.users.verify', compact('token'));
    }

    /**
     * Verificación y actualización de contraseña del usuario.
     */
    public function verify(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string',
            'password' => 'string|min:6|confirmed',
        ]);

        $user = User::where('verification_token', $request->token)->first();

        if (!$user) {
            return back()->with('error', 'Error en las credenciales.');
        }

        $user->update([
            'verification_token' => null,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }

    /**
     * Re envío del correo de verificación al usuario.
     */
    public function resend(User $user)
    {
        if ($user->verified_user()) {
            return back()->with('error', 'Este usuario ya ha sido verificado.');
        }

        retry(5, function() use ($user) {
            $user->notify(new CreationNotification());
        }, 100);

        return back()->with('success', 'El correo de verificación se ha reenviado.');
    }
}
