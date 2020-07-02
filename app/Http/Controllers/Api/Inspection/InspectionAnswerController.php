<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Inspection;
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
}
