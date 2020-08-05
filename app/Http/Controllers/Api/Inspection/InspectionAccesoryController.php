<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transformers\AccesoryTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Accesorios",
 *     description="Endpoints para el módulo de accesorios"
 * )
 */
class InspectionAccesoryController extends ApiControllerV1
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . AccesoryTransformer::class)->only(['store']);
    }

    /**
     * @OA\Get(
     *     path="/inspections/{inspection}/accesories",
     *     summary="Listado de accesorios asociados a una inspección",
     *     tags={"Accesorios"},
     *     @OA\Parameter(
     *         name="inspection",
     *         description="Id de la inspección",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el listado de accesorios asociados a una inspección.",
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
    public function index(Inspection $inspection)
    {
        $accesories = $inspection->accesories;

        return $this->showAll($accesories);
    }

    /**
     * @OA\Post(
     *     path="/inspections/{inspection}/accesories",
     *     summary="Almacena un accesorio asociado a una inspección",
     *     tags={"Accesorios"},
     *     @OA\Parameter(
     *         name="inspection",
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
     *                 required={"name"},
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
     *         description="Almacena una nueva corrosión asociada a una inspección.",
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
    public function store(Request $request, Inspection $inspection)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'measure' => 'string|max:191',
            'serial' => 'string|max:191',
            'date' => 'string|max:191',
            'brand' => 'string|max:191',
            'cant' => 'string|max:191',
            'according' => 'string|max:191',
        ]);

        DB::beginTransaction();
        $accesory = $inspection->accesories()->create($request->all());
        DB::commit();

        return $this->showOne($accesory);
    }
}
