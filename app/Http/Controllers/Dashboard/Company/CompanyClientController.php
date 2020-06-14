<?php

namespace App\Http\Controllers\Dashboard\Company;

use App\City;
use App\State;
use App\Client;
use App\Status;
use App\Company;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyClientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        $countries = Country::all('id', 'name');

        return view('dashboard.companies.clients.create', compact('countries', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'country_id' => 'required|exists:countries,id',
            'state_id' => ['required', 'exists:states,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) State::where('id', $value)->first()->country_id !== $request['country_id']) {
                    $fail($attribute.' no pertenece a al país seleccionado.');
                }
            }],
            'city_id' => ['required', 'exists:cities,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) City::where('id', $value)->first()->state_id !== $request['state_id']) {
                    $fail($attribute.' no pertenece a el estado/departamento seleccionado.');
                }
            }],
            'address' => 'required|string|max:191',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        $company->clients()->create($request->all());

        return redirect()->route('dashboard.companies.show', $company)->with('success', __(":model creado correctamente", ['model' => ucfirst(__('cliente'))]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, Client $client)
    {
        return view('dashboard.companies.clients.show', compact('company', 'client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Client $client)
    {
        $countries = Country::all('id', 'name');

        return view('dashboard.companies.clients.edit', compact('countries', 'company', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, Client $client)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'country_id' => 'required|exists:countries,id',
            'state_id' => ['required', 'exists:states,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) State::where('id', $value)->first()->country_id !== $request['country_id']) {
                    $fail($attribute.' no pertenece a al país seleccionado.');
                }
            }],
            'city_id' => ['required', 'exists:cities,id', function ($attribute, $value, $fail) use ($request) {
                if ((string) City::where('id', $value)->first()->state_id !== $request['state_id']) {
                    $fail($attribute.' no pertenece a el estado/departamento seleccionado.');
                }
            }],
            'address' => 'required|string|max:191',
        ]);

        $client->update($request->all());

        return redirect()->route('dashboard.companies.clients.show', [$company, $client])->with('success', __(":model actualizado correctamente", ['model' => ucfirst(__('cliente'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, Client $client)
    {
        if ($client->delete()){
            return redirect()->route('dashboard.companies.show', $company)->with('success', __(":model eliminado correctamente", ['model' => ucfirst(__('cliente'))]));
        }
    }
}
