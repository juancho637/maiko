<?php

namespace App\Http\Controllers\Api\Answer;

use App\Answer;
use App\Transformers\AnswerTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Respuestas",
 *     description="Endpoints para el módulo de respuestas"
 * )
 */
class AnswerController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . AnswerTransformer::class)->only(['update']);
    }

    /**
     * @OA\Get(
     *     path="/answers/{answer}",
     *     summary="Muestra la información de una respuesta",
     *     tags={"Respuestas"},
     *     @OA\Parameter(
     *         name="answer",
     *         description="Id de la respuesta",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a una respuesta.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Id no encontrado.",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function show(Answer $answer)
    {
        return $this->showOne($answer);
    }
}
