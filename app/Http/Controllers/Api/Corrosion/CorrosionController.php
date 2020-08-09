<?php

namespace App\Http\Controllers\Api\Corrosion;

use App\Status;
use App\Corrosion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Transformers\CorrosionTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Corrosiones",
 *     description="Endpoints para el módulo de corrosiones"
 * )
 */
class CorrosionController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . CorrosionTransformer::class)->only(['update']);
    }

    /**
     * @OA\Get(
     *     path="/corrosions/{corrosion}",
     *     summary="Muestra la información de una corrosión",
     *     tags={"Corrosiones"},
     *     @OA\Parameter(
     *         name="corrosion",
     *         description="Id de la corrosión",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a una corrosión.",
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
    public function show(Corrosion $corrosion)
    {
        return $this->showOne($corrosion);
    }

    /**
     * @OA\Put(
     *     path="/corrosions/{corrosion}",
     *     summary="Actualiza una corrosión",
     *     tags={"Corrosiones"},
     *     @OA\Parameter(
     *         name="corrosion",
     *         description="Id de la corrosión",
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
     *                     property="corrosion_type",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="remaining_thickness",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="area",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="large",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="thickness",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="depth",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="observation",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actualiza una corrosión.",
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
    public function update(Request $request, Corrosion $corrosion)
    {
        $this->validate($request, [
            'corrosion_type'  => [
                Rule::in(Corrosion::CORROSION_TYPES),
            ],
            'remaining_thickness' => 'string',
            'area' => 'string',
            'large' => 'string',
            'thickness' => 'string',
            'depth' => 'string',
            'observation' => 'string',
        ]);

        if ($corrosion->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes actualizar está corrosión porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        if ($request->has('corrosion_type') && $request->corrosion_type !== null) {
            $corrosion->corrosion_type = $request->corrosion_type;
        }

        if ($request->has('remaining_thickness') && $request->remaining_thickness !== null) {
            $corrosion->remaining_thickness = $request->remaining_thickness;
        }

        if ($request->has('area') && $request->area !== null) {
            $corrosion->area = $request->area;
        }

        if ($request->has('large') && $request->large !== null) {
            $corrosion->large = $request->large;
        }

        if ($request->has('thickness') && $request->thickness !== null) {
            $corrosion->thickness = $request->thickness;
        }

        if ($request->has('depth') && $request->depth !== null) {
            $corrosion->depth = $request->depth;
        }

        if ($request->has('observation') && $request->observation !== null) {
            $corrosion->observation = $request->observation;
        }

        if (!$corrosion->isDirty()) {
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $corrosion->save();

        return $this->showOne($corrosion);
    }
}
