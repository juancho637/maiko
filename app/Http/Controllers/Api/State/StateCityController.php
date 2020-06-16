<?php

namespace App\Http\Controllers\Api\State;

use App\State;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Ciudades",
 *     description="Endpoints para el módulo de ciudades"
 * )
 */
class StateCityController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/states/{id}/cities",
     *     summary="Listado de ciudades que pertenece a un estado/departamento",
     *     tags={"Ciudades"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del estado/departamento",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de ciudades asociados a un estados/departamentos.",
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
    public function index(State $state)
    {
        $cities = $state->cities;

        return $this->showAll($cities);
    }
}
