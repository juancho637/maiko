<?php

namespace App\Http\Controllers\Api\User;

use App\User;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Ordenes de trabajo",
 *     description="Endpoints para el módulo de ordenes de trabajo"
 * )
 */
class UserWorkOrderController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/users/{user}/work_orders",
     *     summary="Listado de ordenes de trabajo asociadas a un usuario",
     *     tags={"Ordenes de trabajo"},
     *     @OA\Parameter(
     *         name="user",
     *         description="Id del usuario",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de ordenes de trabajo asociadas a un usuario.",
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
    public function index(User $user)
    {
        $work_orders = $user->work_orders;

        return $this->showAll($work_orders);
    }
}
