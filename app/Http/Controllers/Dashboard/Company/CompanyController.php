<?php

namespace App\Http\Controllers\Dashboard\Company;

use App\City;
use App\State;
use App\Company;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;

class CompanyController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view companies')->only('index');
        $this->middleware('can:view company')->only('show');
        $this->middleware('can:create companies')->only(['create', 'store']);
        $this->middleware('can:edit companies')->only(['edit', 'update']);
        $this->middleware('can:delete companies')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all('id', 'name');

        return view('dashboard.companies.create', compact('countries'));
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
            'name' => 'required|max:191',
            'contact_name' => 'required|string|max:191',
            'contact_number' => 'required|string|max:10',
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

        Company::create($request->all());

        return redirect()->route('dashboard.companies.index')->with('success', __(":model creada correctamente", ['model' => ucfirst(__('empresa'))]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('dashboard.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $countries = Country::all('id', 'name');

        return view('dashboard.companies.edit', compact('company', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'contact_name' => 'required|string|max:191',
            'contact_number' => 'required|string|max:10',
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

        $company->update($request->all());

        return redirect()->route('dashboard.companies.show', $company)->with('success', __(":model actualizada correctamente", ['model' => ucfirst(__('empresa'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->delete()){
            return redirect()->route('dashboard.companies.index')->with('success', __(":model eliminada correctamente", ['model' => ucfirst(__('empresa'))]));
        }
    }
}
