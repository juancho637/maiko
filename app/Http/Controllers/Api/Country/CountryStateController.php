<?php

namespace App\Http\Controllers\Api\Country;

use App\Country;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Estados/departamentos",
 *     description="Endpoints para el módulo de estados/departamentos"
 * )
 */
class CountryStateController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/countries/{id}/states",
     *     summary="Listado de estados/departamentos que pertenece a un país",
     *     tags={"Estados/departamentos"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del país",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de estados/departamentos asociados a un país.",
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
    public function index(Country $country)
    {
        $states = $country->states;

        return $this->showAll($states);
    }
}
