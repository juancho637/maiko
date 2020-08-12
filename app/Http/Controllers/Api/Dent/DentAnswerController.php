<?php

namespace App\Http\Controllers\Api\Dent;

use App\Dent;
use App\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Respuestas",
 *     description="Endpoints para el módulo de respuestas"
 * )
 */
class DentAnswerController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/dents/{dent}/answers",
     *     summary="Listado de respuestas asociadas a una abolladura",
     *     tags={"Respuestas"},
     *     @OA\Parameter(
     *         name="dent",
     *         description="Id de la abolladura",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de respuestas asociadas a una abolladura.",
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
    public function index(Dent $dent)
    {
        $answers = $dent->answers;

        return $this->showAll($answers);
    }

    /**
     * @OA\Put(
     *     path="/dents/{dent}/answers/{answer}",
     *     summary="Actualiza una respuesta asociada a una abolladura",
     *     tags={"Respuestas"},
     *     @OA\Parameter(
     *         name="dent",
     *         description="Id de la abolladura",
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
     *         description="Actualiza una respuesta asociada a una abolladura.",
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
    public function update(Request $request, Dent $dent, Answer $answer)
    {
        $this->validate($request, [
            'value' => 'in:' . $answer->question->possible_response,
        ]);

        if ((int)$dent->id !== (int)$answer->answerable_id && $answer->answerable_type !== 'App\Dent') {
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
