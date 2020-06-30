<?php

namespace App\Http\Controllers\Api\Status;

use App\Status;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Estados",
 *     description="Endpoints para el módulo de estados"
 * )
 */
class StatusController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/statuses",
     *     summary="Listado de estados",
     *     tags={"Estados"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de estados.",
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
        $statuses = Status::all();

        return $this->showAll($statuses);
    }

    /**
     * @OA\Get(
     *     path="/statuses/{id}",
     *     summary="Muestra la información de un estado",
     *     tags={"Estados"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del estado",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a un estado.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Id no encontrado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function show(Status $status)
    {
        return $this->showOne($status);
    }
}
