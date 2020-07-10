<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Question;
use App\Inspection;
use Illuminate\Http\Request;
use App\Transformers\AnswerTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Respuestas",
 *     description="Endpoints para el módulo de respuestas"
 * )
 */
class InspectionQuestionAnswerController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:'.AnswerTransformer::class)->only(['store']);
    }

    /**
     * @OA\Post(
     *     path="/inspections/{inspection}/questions/{question}/answers",
     *     summary="Almacena una respuesta asociada a una inspección",
     *     tags={"Respuestas"},
     *     @OA\Parameter(
     *         name="inspection",
     *         description="Id de la inspección",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="question",
     *         description="Id de la pregunta",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="value",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Almacena una nueva respuesta asociado a una inspección, con una pregunta.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Entidad no procesable.",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function store(Request $request, Inspection $inspection, Question $question)
    {
        $this->validate($request, [
            'value' => 'required|in:'.$question->possible_response,
        ]);

        $answer = $inspection->answers()->create([
            'question_id' => $question->id,
            'value' => $request->value
        ]);

        return $this->showOne($answer);
    }
}
