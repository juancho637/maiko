<?php

namespace App\Http\Controllers\Dashboard\City;

use App\City;
use App\State;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view cities')->only('index');
        $this->middleware('can:view city')->only('show');
        $this->middleware('can:create cities')->only(['create', 'store']);
        $this->middleware('can:edit cities')->only(['edit', 'update']);
        $this->middleware('can:delete cities')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.zones.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::get(['id', 'name']);

        return view('dashboard.zones.cities.create', compact('states'));
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
            'state_id' => 'required|exists:states,id',
        ]);

        $fields = $request->all();
        $fields['status_id'] = Status::where('abbreviation', 'gen-act')->first()->id;

        City::create($fields);

        return redirect()->route('dashboard.cities.index')->with('success', 'Ciudad creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('dashboard.zones.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $states = State::get(['id', 'name']);

        return view('dashboard.zones.cities.edit', compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        $city->update($request->all());

        return redirect()->route('dashboard.cities.index')->with('success', 'Ciudad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        if($city->delete()) {
            return redirect()->route('dashboard.cities.index')->with('success', 'Ciudad eliminada correctamente');
        }
    }
}
