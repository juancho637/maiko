<?php

namespace App\Http\Controllers\Api\State;

use App\State;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Estados/departamentos",
 *     description="Endpoints para el módulo de ciudades"
 * )
 */
class StateController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/states",
     *     summary="Listado de estados/departamentos",
     *     tags={"Estados/departamentos"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de estados/departamentos.",
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
        $states = State::all();

        return $this->showAll($states);
    }

    /**
     * @OA\Get(
     *     path="/states/{id}",
     *     summary="Muestra la información de un estados/departamentos",
     *     tags={"Estados/departamentos"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del estados/departamentos",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra un estados/departamentos dado un id.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function show(State $state)
    {
        return $this->showOne($state);
    }
}
