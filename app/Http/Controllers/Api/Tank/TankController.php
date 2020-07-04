<?php

namespace App\Http\Controllers\Api\Tank;

use App\Tank;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Tanques",
 *     description="Endpoints para el módulo de tanques"
 * )
 */
class TankController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *     path="/tanks/{id}",
     *     summary="Muestra la información de un tanque",
     *     tags={"Tanques"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del tanque",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a un tanque.",
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
    public function show(Tank $tank)
    {
        return $this->showOne($tank);
    }

    /**
     * @OA\Put(
     *     path="/tanks/{id}",
     *     summary="Actualiza un tanque",
     *     tags={"Tanques"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del tanque",
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
     *                     property="client_id",
     *                     type="integer"
     *                 ),
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
    public function update(Request $request, Tank $tank)
    {
        $this->validate($request, [
            'client_id' => 'exists:clients,id',
            'internal_serial_number' => 'string|max:191',
            'serial_number' => 'string|max:191',
            'maker' => 'string|max:191',
            'fabrication_year' => 'required|numeric|min:1900|max:'.date('Y'),
            'capacity' => 'string|max:191',
            'large' => 'string|max:191',
            'diameter' => 'string|max:191',
            'head_thickness' => 'string|max:191',
            'body_thickness' => 'string|max:191',
        ]);

        if ($request->has('client_id') && $request->client_id !== null) {
            $tank->client_id = $request->client_id;
        }

        if ($request->has('internal_serial_number') && $request->internal_serial_number !== null) {
            $tank->internal_serial_number = $request->internal_serial_number;
        }

        if ($request->has('serial_number') && $request->serial_number !== null) {
            $tank->serial_number = $request->serial_number;
        }

        if ($request->has('maker') && $request->maker !== null) {
            $tank->maker = $request->maker;
        }

        if ($request->has('fabrication_year') && $request->fabrication_year !== null) {
            $tank->fabrication_year = $request->fabrication_year;
        }

        if ($request->has('capacity') && $request->capacity !== null) {
            $tank->capacity = $request->capacity;
        }

        if ($request->has('large') && $request->large !== null) {
            $tank->large = $request->large;
        }

        if ($request->has('diameter') && $request->diameter !== null) {
            $tank->diameter = $request->diameter;
        }

        if ($request->has('head_thickness') && $request->head_thickness !== null) {
            $tank->head_thickness = $request->head_thickness;
        }

        if ($request->has('body_thickness') && $request->body_thickness !== null) {
            $tank->body_thickness = $request->body_thickness;
        }

        if (!$tank->isDirty()){
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $tank->save();

        return $this->showOne($tank);
    }
}
