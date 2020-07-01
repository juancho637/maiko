<?php

namespace App\Http\Controllers\Api\Question;

use App\Question;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Preguntas",
 *     description="Endpoints para el módulo de preguntas"
 * )
 */
class QuestionController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/questions",
     *     summary="Listado de preguntas",
     *     tags={"Preguntas"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de preguntas.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function index()
    {
        $questions = Question::all();

        return $this->showAll($questions);
    }

    /**
     * @OA\Get(
     *     path="/questions/{id}",
     *     summary="Muestra la información de una pregunta",
     *     tags={"Preguntas"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la pregunta",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra una pregunta dado un id.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function show(Question $question)
    {
        return $this->showOne($question);
    }
}
