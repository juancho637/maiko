<?php

namespace App\Http\Controllers\Api\WorkOrder;

use App\WorkOrder;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Ordenes de trabajo",
 *     description="Endpoints para el módulo de ordenes de trabajo"
 * )
 */
class WorkOrderController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/work_orders",
     *     summary="Listado de ordenes de trabajo",
     *     tags={"Ordenes de trabajo"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de ordenes de trabajo.",
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
        return $this->showAll(WorkOrder::all());
    }

    /**
     * @OA\Get(
     *     path="/work_orders/{id}",
     *     summary="Muestra la información de una orden de trabajo",
     *     tags={"Ordenes de trabajo"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la orden de trabajo",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a una orden de trabajo.",
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
    public function show(WorkOrder $work_order)
    {
        return $this->showOne($work_order);
    }
}
