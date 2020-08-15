<?php

namespace App\Http\Controllers\DataTable\Corrosion;

use App\Corrosion;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CorrosionAnswerController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view corrosion')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Corrosion $corrosion)
    {
        return DataTables::of($corrosion->answers()
            ->select(['id', 'value', 'question_id'])->with(
                'question:id,question',
            )->get())
            ->toJson();
    }
}
