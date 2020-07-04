<?php

namespace App\Http\Controllers\Api\Client;

use App\Client;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Tanques",
 *     description="Endpoints para el módulo de tanques"
 * )
 */
class ClientTankController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/clients/{id}/tanks",
     *     summary="Listado de tanques",
     *     tags={"Tanques"},
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
     *         description="Muestra el listado de tanques asociados a un cliente.",
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
    public function index(Client $client)
    {
        $tanks = $client->tanks;

        return $this->showAll($tanks);
    }

    /**
     * @OA\Post(
     *     path="/clients/{id}/tanks",
     *     summary="Almacena un tanque",
     *     tags={"Tanques"},
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
     *                     property="internal_serial_number",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="serial_number",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="maker",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="fabrication_year",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="capacity",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="large",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="diameter",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="head_thickness",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="body_thickness",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Almacena un nuevo tanque asociado a un cliente.",
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
    public function store(Request $request, Client $client)
    {
        $this->validate($request, [
            'internal_serial_number' => 'required|string|max:191',
            'serial_number' => 'required|string|max:191',
            'maker' => 'required|string|max:191',
            'fabrication_year' => 'required|numeric|min:1900|max:'.date('Y'),
            'capacity' => 'required|string|max:191',
            'large' => 'required|string|max:191',
            'diameter' => 'required|string|max:191',
            'head_thickness' => 'required|string|max:191',
            'body_thickness' => 'required|string|max:191',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        $tank = $client->tanks()->create($request->all());

        return $this->showOne($tank);
    }
}
