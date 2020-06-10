<?php

namespace App\Http\Controllers\Dashboard\Country;

use App\Status;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view countries')->only('index');
        $this->middleware('can:view country')->only('show');
        $this->middleware('can:create countries')->only(['create', 'store']);
        $this->middleware('can:edit countries')->only(['edit', 'update']);
        $this->middleware('can:delete countries')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.zones.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.zones.countries.create');
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
            'short_name' => 'required|string|max:4',
            'phone_code' => 'required|numeric|max:3',
        ]);

        $fields = $request->all();
        $fields['status_id'] = Status::where('abbreviation', 'gen-act')->first()->id;

        Country::create($fields);

        return redirect()->route('dashboard.countries.index')->with('success', 'País creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('dashboard.zones.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('dashboard.zones.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:4',
            'phone_code' => 'required|numeric|max:999',
        ]);

        $country->update($request->all());

        return redirect()->route('dashboard.countries.index')->with('success', 'País actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        if($country->delete()) {
            return redirect()->route('dashboard.services.index')->with('success', 'País eliminado correctamente');
        }
    }
}
