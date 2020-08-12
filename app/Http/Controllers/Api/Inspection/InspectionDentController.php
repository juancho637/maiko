<?php

namespace App\Http\Controllers\Api\Inspection;

use App\Status;
use App\Question;
use App\Inspection;
use Illuminate\Http\Request;
use App\Traits\StorageDriver;
use App\Helpers\QuestionsAnswers;
use Illuminate\Support\Facades\DB;
use App\Transformers\DentTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

class InspectionDentController extends ApiControllerV1
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . DentTransformer::class)->only(['store']);
    }

    /**
     * @OA\Get(
     *     path="/inspections/{inspection}/dents",
     *     summary="Listado de abolladuras asociadas a una inspección",
     *     tags={"Abolladuras"},
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
     *         description="Muestra el listado de abolladuras asociadas a una inspección.",
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
        $dents = $inspection->dents;

        return $this->showAll($dents);
    }

    /**
     * @OA\Post(
     *     path="/inspections/{inspection}/dents",
     *     summary="Almacena una abolladura",
     *     tags={"Abolladuras"},
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
     *                 required={"large", "width", "average", "files"},
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
     *         description="Almacena una nueva abolladura asociada a una inspección.",
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
            'large' => 'required|string',
            'width' => 'required|string',
            'average' => 'required|string',
            'files' => 'required|array|min:5',
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'observation' => 'string',
            'answers' => 'required|array',
        ]);

        $questions_answers = new QuestionsAnswers(Question::MODULE_DENT, $request->answers);

        if (!empty($questions_answers->validate_answers())) {
            return $this->errorResponse($questions_answers->validate_answers(), 409);
        }

        if ($inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes crear una abolladura asociada a está inspección porque ya fue finalizada.'), 409);
        }

        $request['status_id'] = Status::abbreviation('gen-act')->id;

        DB::beginTransaction();
        $dent = $inspection->dents()->create($request->all());

        foreach ($questions_answers->get_answers() as $answer) {
            $dent->answers()->create([
                'question_id' => $answer['question_id'],
                'value' => $answer['answer']
            ]);
        }

        foreach ($request->file('files') as $file) {
            $dent->files()->create([
                'path' => $this->store_file($file, 'inspections/' . $inspection->id . '/dents/' . $dent->id, 'private')
            ]);
        }
        DB::commit();

        return $this->showOne($dent);
    }
}
