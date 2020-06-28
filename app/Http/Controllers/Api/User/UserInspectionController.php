<?php

namespace App\Http\Controllers\Api\User;

use App\User;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Inspecciones",
 *     description="Endpoints para el módulo de inspecciones"
 * )
 */
class UserInspectionController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/users/{id}/inspections",
     *     summary="Listado de inspecciones",
     *     tags={"Inspecciones"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del usuario",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de inspecciones asociadas a un usuario.",
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
        $inspections = $user->inspections;

        return $this->showAll($inspections);
    }
}
