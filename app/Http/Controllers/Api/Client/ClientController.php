<?php

namespace App\Http\Controllers\Api\Client;

use App\Client;
use Illuminate\Http\Request;
use App\Transformers\ClientTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Clientes",
 *     description="Endpoints para el módulo de clientes"
 * )
 */
class ClientController extends ApiControllerV1
{
    /**
     * Create a new CompanyController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:'.ClientTransformer::class)->only(['update']);
    }

    /**
     * @OA\Get(
     *     path="/clients/{id}",
     *     summary="Muestra la información de un cliente",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del cliente",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociadas a un cliente.",
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
    public function show(Client $client)
    {
        return $this->showOne($client);
    }

    /**
     * @OA\Put(
     *     path="/clients/{id}",
     *     summary="Actualiza un cliente",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del cliente",
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
     *                     property="city",
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
     *         description="se debe especificar al menos un valor diferente para actualizar.",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request, [
            'name' => 'string|max:191',
            'city_id' => 'exists:cities,id',
            'address' => 'string|max:191',
        ]);

        if ($request->has('name') && $request->name !== null) {
            $client->name = $request->name;
        }

        if ($request->has('city_id') && $request->city_id !== null) {
            $client->city_id = $request->city_id;
        }

        if ($request->has('address') && $request->address !== null) {
            $client->address = $request->address;
        }

        if (!$client->isDirty()){
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $client->save();

        return $this->showOne($client);
    }
}
