<?php

namespace App\Http\Controllers\Api\WorkOrder;

use App\Status;
use App\WorkOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Inspecciones",
 *     description="Endpoints para el módulo de inspecciones"
 * )
 */
class WorkOrderInspectionController extends ApiControllerV1
{
    /**
     * @OA\Post(
     *     path="/work_orders/{id}/inspections",
     *     summary="Almacena una inspección",
     *     tags={"Inspecciones"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la orden de trabajo",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "latitude", "longitude", "date"},
     *             @OA\Property(
     *                 property="user_id",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="latitude",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="longitude",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="date",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="tank_id",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="client_id",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="observation",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="light_intensity",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="humidity",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="temperature",
     *                 type="string"
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Almacena una nueva inspección asociada a una orden de trabajo.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Error en validaciones de negocio.",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Entidad no procesable.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function store(Request $request, WorkOrder $work_order)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'date' => 'required|date_format:Y-m-d',
            'tank_id' => 'exists:tanks,id',
            'client_id' => 'exists:clients,id',
            'observation' => 'string',
            'light_intensity' => 'string',
            'humidity' => 'string',
            'temperature' => 'string',
        ]);

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        if ($request->has('tank_id') && $request->tank_id !== null && $request->has('client_id') && $request->client_id !== null) {
            $client = $work_order
                        ->company
                        ->clients()
                        ->where('id', $request->client_id)
                        ->first();

            $tank = $client->tanks()->where('id', $request->tank_id)->first();

            if (!$client) {
                return $this->errorResponse(__('Este cliente no pertenece a la empresa de la orden de trabajo dada.'), 409);
            }

            if (!$tank) {
                return $this->errorResponse(__('Este tanque no pertenece al cliente de la empresa en la orden de trabajo dada.'), 409);
            }

            $request['city_id'] = $client->city_id;
            $request['address'] = $client->address;
        } elseif ($request->has('tank_id') && $request->tank_id !== null && !$request->has('client_id')) {
            $tank = $work_order
                        ->company
                        ->clients()
                        ->with('tanks')
                        ->get()
                        ->pluck('tanks')
                        ->collapse()
                        ->where('id', $request->tank_id)
                        ->first();


            if (!$tank) {
                return $this->errorResponse(__('Este tanque no pertenece a la empresa de la orden de trabajo dada.'), 409);
            }

            $request['city_id'] = $tank->client->city_id;
            $request['address'] = $tank->client->address;
        } elseif ($request->has('client_id') && $request->client_id !== null && !$request->has('tank_id')) {
            $client = $work_order
                        ->company
                        ->clients()
                        ->where('id', $request->client_id)
                        ->first();

            if (!$client) {
                return $this->errorResponse(__('Este cliente no pertenece a la empresa de la orden de trabajo dada.'), 409);
            }

            $request['city_id'] = $client->city_id;
            $request['address'] = $client->address;
        }

        $inspection = $work_order->inspections()->create($request->all());

        return $this->showOne($inspection);
    }
}
