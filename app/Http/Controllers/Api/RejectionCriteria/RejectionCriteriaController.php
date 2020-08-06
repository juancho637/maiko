<?php

namespace App\Http\Controllers\Api\RejectionCriteria;

use App\Status;
use App\RejectionCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiControllerV1;
use App\Transformers\RejectionCriteriaTransformer;

/**
 * @OA\Tag(
 *     name="Criterios de rechazo",
 *     description="Endpoints para el módulo de criterios de rechazo"
 * )
 */
class RejectionCriteriaController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . RejectionCriteriaTransformer::class)->only(['update']);
    }

    /**
     * @OA\Get(
     *     path="/rejection_criterias/{rejection_criteria}",
     *     summary="Muestra la información de un criterio de rechazo",
     *     tags={"Criterios de rechazo"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del criterio de rechazo",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a un criterio de rechazo.",
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
    public function show(RejectionCriteria $rejection_criteria)
    {
        return $this->showOne($rejection_criteria);
    }
}
