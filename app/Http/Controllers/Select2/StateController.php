<?php

namespace App\Http\Controllers\Select2;

use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = State::select('id', 'name AS text')->name($request->search)->where('country_id', $request->country)->get();

        return response()->json($states, 200);
    }
}
