<?php

namespace App\Http\Controllers\Select2;

use App\Tank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TankController extends Controller
{
    public function index(Request $request)
    {
        $states = Tank::select('id', 'internal_serial_number')
                    ->where('client_id', $request->client_id)
                    ->get();

        return response()->json($states, 200);
    }
}
