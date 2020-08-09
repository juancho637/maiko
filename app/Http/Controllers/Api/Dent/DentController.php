<?php

namespace App\Http\Controllers\Api\Dent;

use App\Dent;
use App\Status;
use Illuminate\Http\Request;
use App\Transformers\DentTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Abolladuras",
 *     description="Endpoints para el módulo de abolladuras"
 * )
 */
class DentController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . DentTransformer::class)->only(['update']);
    }


    /**
     * @OA\Get(
     *     path="/dents/{dent}",
     *     summary="Muestra la información de una abolladura",
     *     tags={"Abolladuras"},
     *     @OA\Parameter(
     *         name="dent",
     *         description="Id de la abolladura",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra la información asociada a una abolladura.",
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
    public function show(Dent $dent)
    {
        return $this->showOne($dent);
    }

    /**
     * @OA\Put(
     *     path="/dents/{dent}",
     *     summary="Actualiza una abolladura",
     *     tags={"Abolladuras"},
     *     @OA\Parameter(
     *         name="dent",
     *         description="Id de la abolladura",
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
     *                     property="large",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="width",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="average",
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
     *         description="Actualiza una abolladura.",
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
    public function update(Request $request, Dent $dent)
    {
        $this->validate($request, [
            'large' => 'string',
            'width' => 'string',
            'average' => 'string',
            'observation' => 'string',
        ]);

        if ($dent->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes actualizar está abolladura porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        if ($request->has('large') && $request->large !== null) {
            $dent->large = $request->large;
        }

        if ($request->has('width') && $request->width !== null) {
            $dent->width = $request->width;
        }

        if ($request->has('average') && $request->average !== null) {
            $dent->average = $request->average;
        }

        if ($request->has('observation') && $request->observation !== null) {
            $dent->observation = $request->observation;
        }

        if (!$dent->isDirty()) {
            return $this->errorResponse(
                ucfirst(__('se debe especificar al menos un valor diferente para actualizar')),
                422
            );
        }

        $dent->save();

        return $this->showOne($dent);
    }
}
