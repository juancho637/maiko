<?php

namespace App\Http\Controllers\Select2;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::name($request->search)->get();

        $formatted_cities = [];

        foreach ($cities as $city) {
            $formatted_cities[] = [
                'id' => $city->id,
                'text' => $city->name,
            ];
        }

        return response()->json($formatted_cities, 200);
    }
}
