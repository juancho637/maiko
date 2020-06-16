<?php

namespace App\Http\Controllers\Api\City;

use App\City;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Ciudades",
 *     description="Endpoints para el módulo de ciudades"
 * )
 */
class CityController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/cities",
     *     summary="Listado de ciudades",
     *     tags={"Ciudades"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de ciudades.",
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
        $cities = City::all();

        return $this->showAll($cities);
    }

    /**
     * @OA\Get(
     *     path="/cities/{id}",
     *     summary="Muestra la información de un ciudad",
     *     tags={"Ciudades"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la ciudad",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra una ciudad dado un id.",
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
    public function show(City $city)
    {
        return $this->showOne($city);
    }
}
