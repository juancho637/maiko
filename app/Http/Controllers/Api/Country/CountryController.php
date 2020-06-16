<?php

namespace App\Http\Controllers\Api\Country;

use App\Country;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Países",
 *     description="Endpoints para el módulo de países"
 * )
 */
class CountryController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/countries",
     *     summary="Listado de países",
     *     tags={"Países"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de países.",
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
        $countries = Country::all();

        return $this->showAll($countries);
    }

    /**
     * @OA\Get(
     *     path="/countries/{id}",
     *     summary="Muestra la información de un país",
     *     tags={"Países"},
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
     *         description="Muestra un país dado un id.",
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
    public function show(Country $country)
    {
        return $this->showOne($country);
    }
}
