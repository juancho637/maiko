<?php

namespace App\Http\Controllers\Api\Dent;

use App\Dent;
use App\File;
use App\Status;
use Illuminate\Http\Request;
use App\Traits\StorageDriver;
use App\Transformers\FileTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Abolladuras",
 *     description="Endpoints para el módulo de abolladuras"
 * )
 */
class DentFileController extends ApiControllerV1
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:' . FileTransformer::class)->only(['store', 'update']);
    }

    /**
     * @OA\Get(
     *     path="/dents/{dent}/files",
     *     summary="Listado de archivos asociadas a una abolladura",
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
     *         description="Muestra el listado de archivos asociadas a una abolladura.",
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
    public function index(Dent $dent)
    {
        $files = $dent->files;

        return $this->showAll($files);
    }

    /**
     * @OA\Post(
     *     path="/dents/{dent}/files",
     *     summary="Almacena un archivo asociado a una abolladura",
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
     *                 required={"file"},
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary",
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Almacena un nuevo archivo asociado a una abolladura.",
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
    public function store(Request $request, Dent $dent)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($dent->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes crear una imágen en está abolladura porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        $file = $dent->files()->create([
            'path' => $this->store_file($request->file('file'), 'inspections/' . $dent->inspection_id . '/dents/' . $dent->id, 'private')
        ]);

        return $this->showOne($file);
    }

    /**
     * @OA\Get(
     *     path="/dents/{dent}/files/{file}",
     *     summary="Muestra un archivo asociado a una abolladura",
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
     *     @OA\Parameter(
     *         name="file",
     *         description="Id del archivo",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra un archivo asociado a una abolladura.",
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
    public function show(Dent $dent, File $file)
    {
        if (!$dent->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(__('El archivo no existe o no esta asociado a esta abolladura.'), 409);
        }

        return $this->show_file($file->path);
    }

    /**
     * @OA\Put(
     *     path="/dents/{dent}/files/{file}",
     *     summary="Actualiza un archivo asociado a una abolladura",
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
     *     @OA\Parameter(
     *         name="file",
     *         description="Id del archivo",
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
     *                 required={"file"},
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary",
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actualiza un archivo asociado a una abolladura.",
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
    public function update(Request $request, Dent $dent, File $file)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (!$dent->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(__('El archivo no existe o no esta asociado a esta abolladura.'), 409);
        }

        if ($dent->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes actualizar la imágen en está abolladura porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        $this->delete_file_only($file->path);

        $file->path = $this->store_file($request->file('file'), 'inspections/' . $dent->inspection_id . '/dents/' . $dent->id, 'private');

        $file->save();

        return $this->showOne($file);
    }

    /**
     * @OA\Delete(
     *     path="/dents/{dent}/files/{file}",
     *     summary="Elimina un archivo asociado a una abolladura",
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
     *     @OA\Parameter(
     *         name="file",
     *         description="Id del archivo",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Elimina un archivo asociado a una abolladura.",
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
    public function destroy(Dent $dent, File $file)
    {
        if (!$dent->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(__('El archivo no existe o no esta asociado a esta abolladura.'), 409);
        }

        if ($dent->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes eliminar el archivo de está abolladura porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        if ($dent->files()->count() <= 5) {
            return $this->errorResponse(__('No puedes eliminar este archivo porque una abolladura debe terner mínimo 5 archivos.'), 409);
        }

        $this->delete_file($file);

        return $this->showOne($file);
    }
}
