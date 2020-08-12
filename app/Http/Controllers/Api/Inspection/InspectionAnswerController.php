<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Answer;
use App\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Respuestas",
 *     description="Endpoints para el módulo de respuestas"
 * )
 */
class InspectionAnswerController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/inspections/{inspection}/answers",
     *     summary="Listado de respuestas asociadas a una inspección",
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
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de respuestas asociadas a una inspección.",
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
    public function index(Inspection $inspection)
    {
        $answers = $inspection->answers;

        return $this->showAll($answers);
    }

    /**
     * @OA\Put(
     *     path="/inspections/{inspection}/answers/{answer}",
     *     summary="Actualiza una respuesta asociada a una inspección",
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
     *         name="answer",
     *         description="Id de la respuesta",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"value"},
     *                 @OA\Property(
     *                     property="value",
     *                     type="string"
     *                 ),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actualiza una respuesta asociada a una inspección.",
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
    public function update(Request $request, Inspection $inspection, Answer $answer)
    {
        $this->validate($request, [
            'value' => 'in:' . $answer->question->possible_response,
        ]);

        if ((int)$inspection->id !== (int)$answer->answerable_id && $answer->answerable_type !== 'App\Inspection') {
            return $this->errorResponse(__('La pregunta no pertenece al módulo de abolladuras.'), 409);
        }

        if ($request->has('value') && $request->value !== null) {
            $answer->value = $request->value;
        }

        if (!$answer->isDirty()) {
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $answer->save();

        return $this->showOne($answer);
    }
}
