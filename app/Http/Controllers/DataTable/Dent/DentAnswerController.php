<?php

namespace App\Http\Controllers\DataTable\Dent;

use App\Dent;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DentAnswerController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view dent')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Dent $dent)
    {
        return DataTables::of($dent->answers()
            ->select(['id', 'value', 'question_id'])->with(
                'question:id,question',
            )->get())
            ->toJson();
    }
}
