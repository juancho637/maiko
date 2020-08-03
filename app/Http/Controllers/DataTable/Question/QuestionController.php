<?php

namespace App\Http\Controllers\DataTable\Question;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view questions')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(Question::query())
            ->editColumn('module', function (Question $question) {
                return __($question->module);
            })
            ->addColumn('actions', 'dashboard.questions.partials.actions')
            ->rawColumns(['actions'])
            ->toJson();
    }
}
