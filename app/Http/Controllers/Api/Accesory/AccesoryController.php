<?php

namespace App\Http\Controllers\Api\Accesory;

use App\Status;
use App\Accesory;
use Illuminate\Http\Request;
use App\Transformers\AccesoryTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Accesorios",
 *     description="Endpoints para el módulo de accesorios"
 * )
 */
class AccesoryController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . AccesoryTransformer::class)->only(['update']);
    }

    /**
     * @OA\Get(
     *     path="/accesories/{accesory}",
     *     summary="Muestra la información de un accesorio",
     *     tags={"Accesorios"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del accesorio",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a un accesorio.",
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
    public function show(Accesory $accesory)
    {
        return $this->showOne($accesory);
    }

    /**
     * @OA\Put(
     *     path="/accesories/{accesory}",
     *     summary="Actualiza un accesorio",
     *     tags={"Accesorios"},
     *     @OA\Parameter(
     *         name="id",
     *         description="Id del accesorio",
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
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="measure",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="serial",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="date",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="brand",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cant",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="according",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actualiza una accesorio.",
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
    public function update(Request $request, Accesory $accesory)
    {
        $this->validate($request, [
            'name' => 'string|max:191',
            'measure' => 'string|max:191',
            'serial' => 'string|max:191',
            'date' => 'string|max:191',
            'brand' => 'string|max:191',
            'cant' => 'string|max:191',
            'according' => 'string|max:191',
        ]);

        if ($accesory->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes actualizar este accesorio porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        if ($request->has('name') && $request->name !== null) {
            $accesory->name = $request->name;
        }

        if ($request->has('measure') && $request->measure !== null) {
            $accesory->measure = $request->measure;
        }

        if ($request->has('serial') && $request->serial !== null) {
            $accesory->serial = $request->serial;
        }

        if ($request->has('date') && $request->date !== null) {
            $accesory->date = $request->date;
        }

        if ($request->has('brand') && $request->brand !== null) {
            $accesory->brand = $request->brand;
        }

        if ($request->has('cant') && $request->cant !== null) {
            $accesory->cant = $request->cant;
        }

        if ($request->has('according') && $request->according !== null) {
            $accesory->according = $request->according;
        }

        if (!$accesory->isDirty()) {
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $accesory->save();

        return $this->showOne($accesory);
    }
}
