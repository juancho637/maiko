<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Criterios de rechazo",
 *     description="Endpoints para el módulo de criterios de rechazo"
 * )
 */
class InspectionRejectionCriteriaController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . RejectionCriteriaTransformer::class)->only(['store']);
    }

    /**
     * @OA\Get(
     *     path="/inspections/{inspection}/rejection_criterias",
     *     summary="Listado de criterios de rechazo asociados a una inspección",
     *     tags={"Criterios de rechazo"},
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
     *         description="Muestra el listado de criterios de rechazo asociados a una inspección.",
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
        $rejection_criterias = $inspection->rejection_criterias;

        return $this->showAll($rejection_criterias);
    }
}
