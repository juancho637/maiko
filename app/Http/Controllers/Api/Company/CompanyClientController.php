<?php

namespace App\Http\Controllers\Api\Company;

use App\Status;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Clientes",
 *     description="Endpoints para el módulo de clientes"
 * )
 */
class CompanyClientController extends ApiControllerV1
{
    /**
     * Create a new CompanyController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/companies/{id}/clients",
     *     summary="Listado de clientes",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la empresa",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de clientes asociadas a una empresa.",
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
    public function index(Company $company)
    {
        $clients = $company->clients;

        return $this->showAll($clients);
    }

    /**
     * @OA\Post(
     *     path="/companies/{id}/clients",
     *     summary="Almacena un cliente",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la empresa",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="city_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Almacena un nuevo cliente asociado a una empresa.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Entidad no procesable.",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function store(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:191',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        $client = $company->clients()->create($request->all());

        return $this->showOne($client);
    }
}
