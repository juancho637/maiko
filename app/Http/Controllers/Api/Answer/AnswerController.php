<?php

namespace App\Http\Controllers\Api\Answer;

use App\Answer;
use Illuminate\Http\Request;
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

    /**
     * @OA\Put(
     *     path="/answers/{answer}",
     *     summary="Actualiza una respuesta",
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="value",
     *                 type="string"
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actualiza una respuesta.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Error en validaciones de negocio.",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Entidad no procesable.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function update(Request $request, Answer $answer)
    {
        $this->validate($request, [
            'value' => 'in:'.$answer->question->possible_response,
        ]);

        if ($request->has('value') && $request->value !== null) {
            $answer->value = $request->value;
        }

        if (!$answer->isDirty()){
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $answer->save();

        return $this->showOne($answer);
    }
}
