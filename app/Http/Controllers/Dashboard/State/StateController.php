<?php

namespace App\Http\Controllers\Dashboard\State;

use App\State;
use App\Status;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view states')->only('index');
        $this->middleware('can:view state')->only('show');
        $this->middleware('can:create states')->only(['create', 'store']);
        $this->middleware('can:edit states')->only(['edit', 'update']);
        $this->middleware('can:delete states')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.zones.states.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get(['id', 'name']);

        return view('dashboard.zones.states.create', compact('countries'));
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
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $fields = $request->all();
        $fields['status_id'] = Status::where('abbreviation', 'gen-act')->first()->id;

        State::create($fields);

        return redirect()->route('dashboard.states.index')->with('success', 'Estado/Departamento creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        return view('dashboard.zones.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countries = Country::all(['id', 'name']);

        return view('dashboard.zones.states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
        ]);

        $state->update($request->all());

        return redirect()->route('dashboard.states.index')->with('success', 'Estado/Departamento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        if($state->delete()) {
            return redirect()->route('dashboard.states.index')->with('success', 'Estado/Departamento eliminado correctamente');
        }
    }
}
