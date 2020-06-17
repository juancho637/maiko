<?php

namespace App\Http\Controllers\Select2;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = Client::select('id', 'name')
                    ->where('name', 'LIKE', '%'.$request->name.'%')
                    ->where('company_id', $request->company_id)
                    ->get();

        return response()->json($states, 200);
    }
}
