<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Status;
use App\Corrosion;
use App\Inspection;
use Illuminate\Http\Request;
use App\Traits\StorageDriver;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Transformers\CorrosionTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Corrosiones",
 *     description="Endpoints para el módulo de corrosiones"
 * )
 */
class InspectionCorrosionController extends ApiControllerV1
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . CorrosionTransformer::class)->only(['store']);
    }

    /**
     * @OA\Get(
     *     path="/inspections/{inspection}/corrosions",
     *     summary="Listado de corrisiones asociadas a una inspección",
     *     tags={"Corrosiones"},
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
     *         description="Muestra el listado de corrisiones asociadas a una inspección.",
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
        $corrosions = $inspection->corrosions;

        return $this->showAll($corrosions);
    }

    /**
     * @OA\Post(
     *     path="/inspections/{inspection}/corrosions",
     *     summary="Almacena una corrosión",
     *     tags={"Corrosiones"},
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
     *                 required={"corrosion_type", "remaining_thickness", "area", "large", "thickness", "depth", "files"},
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
     *                     property="files",
     *                     type="array",
     *                     @OA\Items(
     *                         type="string",
     *                         format="binary",
     *                     ),
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
     *         description="Almacena una nueva corrosión asociada a una inspección.",
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
    public function store(Request $request, Inspection $inspection)
    {
        $this->validate($request, [
            'corrosion_type'  => [
                'required',
                Rule::in(Corrosion::CORROSION_TYPES),
            ],
            'remaining_thickness' => 'required|string',
            'area' => 'required|string',
            'large' => 'required|string',
            'thickness' => 'required|string',
            'depth' => 'required|string',
            'files' => 'required|array|min:5',
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'observation' => 'string',
        ]);

        if ($inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes crear una corrosión asociada a está inspección porque ya fue finalizada.'), 409);
        }

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        DB::beginTransaction();
        $corrosion = $inspection->corrosions()->create($request->all());

        foreach ($request->file('files') as $file) {
            $corrosion->files()->create([
                'path' => $this->store_file($file, 'inspections/' . $inspection->id . '/corrosions/' . $corrosion->id, 'private')
            ]);
        }
        DB::commit();

        return $this->showOne($corrosion);
    }
}
