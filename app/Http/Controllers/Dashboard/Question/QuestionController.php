<?php

namespace App\Http\Controllers\Dashboard\Question;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Inicialización de funcionalidades que va a requerir el controlador.
     */
    public function __construct()
    {
        $this->middleware('can:view questions')->only('index');
        $this->middleware('can:view question')->only('show');
        $this->middleware('can:create questions')->only(['create', 'store']);
        $this->middleware('can:edit questions')->only(['edit', 'update']);
        $this->middleware('can:delete questions')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.questions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Question::MODULES;
        $response_types = Question::RESPONSE_TYPES;

        return view('dashboard.questions.create', compact('modules', 'response_types'));
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
            'module' => [
                'required',
                Rule::in(Question::MODULES),
            ],
            'response_type' => [
                'required',
                Rule::in(Question::RESPONSE_TYPES),
            ],
            'question' => 'required|string|max:191',
            'possible_response' => 'required|string',
        ]);

        Question::create($request->all());

        return redirect()->route('dashboard.questions.index')->with('success', __(":model creada correctamente", ['model' => ucfirst(__('pregunta'))]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('dashboard.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $modules = Question::MODULES;
        $response_types = Question::RESPONSE_TYPES;

        return view('dashboard.questions.edit', compact('question', 'modules', 'response_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->validate($request, [
            'module' => [
                'required',
                Rule::in(Question::MODULES),
            ],
            'response_type' => [
                'required',
                Rule::in(Question::RESPONSE_TYPES),
            ],
            'question' => 'required|string|max:191',
            'possible_response' => 'required|string',
        ]);

        $question->update($request->all());

        return redirect()->route('dashboard.questions.show', $question)->with('success', __(":model actualizada correctamente", ['model' => ucfirst(__('pregunta'))]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if($question->delete()) {
            return redirect()->route('dashboard.questions.index')->with('success', __(":model eliminada correctamente", ['model' => ucfirst(__('pregunta'))]));
        }
    }
}
