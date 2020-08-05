<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Status;
use App\Question;
use App\Inspection;
use Illuminate\Http\Request;
use App\Traits\StorageDriver;
use Illuminate\Support\Facades\DB;
use App\Transformers\InspectionTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Inspecciones",
 *     description="Endpoints para el módulo de inspecciones"
 * )
 */
class InspectionController extends ApiControllerV1
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . InspectionTransformer::class)->only(['update', 'complete']);
    }

    /**
     * @OA\Get(
     *     path="/inspections/{id}",
     *     summary="Muestra la información de una inspección",
     *     tags={"Inspecciones"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la inspección",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a una inspección.",
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
    public function show(Inspection $inspection)
    {
        return $this->showOne($inspection);
    }

    /**
     * @OA\Put(
     *     path="/inspections/{id}",
     *     summary="Actualiza una inspección",
     *     tags={"Inspecciones"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la inspección",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="tank",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="client",
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
     *         description="Actualiza una inspección.",
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
    public function update(Request $request, Inspection $inspection)
    {
        $this->validate($request, [
            'tank_id' => 'exists:tanks,id',
            'client_id' => 'exists:clients,id',
            'observation' => 'string',
            'light_intensity' => 'string',
            'humidity' => 'string',
            'temperature' => 'string',
        ]);

        if ($inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes actualizar esta inspección ya que ha sido finalizada.'), 409);
        }

        if ($request->has('tank_id') && $request->tank_id !== null && $request->has('client_id') && $request->client_id !== null) {
            $client = $inspection
                ->work_order
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

            $inspection->tank_id = $request->tank_id;
            $inspection->city_id = $client->city_id;
            $inspection->address = $client->address;
        } elseif ($request->has('tank_id') && $request->tank_id !== null && !$request->has('client_id')) {
            $tank = $inspection
                ->work_order
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

            $inspection->tank_id = $request->tank_id;
            $inspection->city_id = $tank->client->city_id;
            $inspection->address = $tank->client->address;
        } elseif ($request->has('client_id') && $request->client_id !== null && !$request->has('tank_id')) {
            $client = $inspection
                ->work_order
                ->company
                ->clients()
                ->where('id', $request->client_id)
                ->first();

            if (!$client) {
                return $this->errorResponse(__('Este cliente no pertenece a la empresa de la orden de trabajo dada.'), 409);
            }

            $inspection->city_id = $client->city_id;
            $inspection->address = $client->address;
        }

        if ($request->has('observation') && $request->observation !== null) {
            $inspection->observation = $request->observation;
        }

        if ($request->has('light_intensity') && $request->light_intensity !== null) {
            $inspection->light_intensity = $request->light_intensity;
        }

        if ($request->has('humidity') && $request->humidity !== null) {
            $inspection->humidity = $request->humidity;
        }

        if ($request->has('temperature') && $request->temperature !== null) {
            $inspection->temperature = $request->temperature;
        }

        if (!$inspection->isDirty()) {
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $inspection->save();

        return $this->showOne($inspection);
    }

    /**
     * @OA\Post(
     *     path="/inspections/{id}/complete",
     *     summary="Completa una inspección",
     *     tags={"Inspecciones"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id de la inspección",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"status", "files"},
     *                 @OA\Property(
     *                     property="status",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="files",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         format="binary",
     *                     ),
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Completa una inspección dado su id.",
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
    public function complete(Request $request, Inspection $inspection)
    {
        $this->validate($request, [
            'status_id' => 'required|exists:statuses,id',
            'files' => 'required|array|min:1',
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $error = [];

        foreach ($inspection->getAttributes() as $key => $value) {
            if (is_null($value)) {
                if ($key === "deleted_at") {
                    continue;
                }

                if ($key === "certificate_number") {
                    continue;
                }

                if ($key === "observation") {
                    continue;
                }

                $error[$key] = [
                    'El campo ' . __($key) . ' es obligatorio.'
                ];
            }
        }

        if ($error) {
            return $this->errorResponse($error, 422);
        }

        $emptyQuestions = Question::byModule('inspections')
            ->get()
            ->pluck('id')
            ->diff(
                $inspection->answers()
                    ->pluck('question_id')
            );

        if (!$emptyQuestions->isEmpty()) {
            $errors = [];

            foreach ($emptyQuestions as $emptyQuestion) {
                $errors[$emptyQuestion] = [
                    __('La pregunta con id :number no se encuentra diligenciada.', ['number' => $emptyQuestion])
                ];
            }

            return $this->errorResponse($errors, 409);
        }

        $status = Status::where('id', $request->status_id)->first();

        if ($status->type !== "inspections") {
            return $this->errorResponse(__('El estado no pertenece al módulo de inspecciones.'), 409);
        }

        $inspection->status_id = $request->status_id;

        DB::beginTransaction();
        foreach ($request->file('files') as $file) {
            $inspection->files()->create([
                'path' => $this->store_file($file, 'inspections/' . $inspection->id, 'private')
            ]);
        }

        $inspection->save();
        DB::commit();

        return $this->showOne($inspection);
    }
}
