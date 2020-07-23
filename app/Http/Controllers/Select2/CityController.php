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
        $cities = City::select('id', 'name AS text')
            ->name($request->search)
            ->byState($request->state)
            ->get();

        return response()->json($cities, 200);
    }
}
