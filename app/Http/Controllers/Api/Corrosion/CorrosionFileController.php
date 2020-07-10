<?php

namespace App\Http\Controllers\Api\Corrosion;

use App\File;
use App\Status;
use App\Corrosion;
use Illuminate\Http\Request;
use App\Traits\StorageDriver;
use App\Transformers\FileTransformer;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Corrosiones",
 *     description="Endpoints para el módulo de corrosiones"
 * )
 */
class CorrosionFileController extends ApiControllerV1
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('transform.input:'.FileTransformer::class)->only(['store', 'update']);
    }

    /**
     * @OA\Get(
     *     path="/corrosions/{corrosion}/files",
     *     summary="Listado de archivos asociadas a una corrosión",
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
     *         description="Muestra el listado de archivos asociadas a una corrosión.",
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
    public function index(Corrosion $corrosion)
    {
        $files = $corrosion->files;

        return $this->showAll($files);
    }

    /**
     * @OA\Post(
     *     path="/corrosions/{corrosion}/files",
     *     summary="Almacena un archivo asociado a una corrosión",
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
     *         description="Almacena un nuevo archivo asociado a una corrosión.",
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
    public function store(Request $request, Corrosion $corrosion)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($corrosion->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes crear una imágen en está corrosión porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        $file = $corrosion->files()->create([
            'path' => $this->store_file($request->file('file'), 'inspections/'.$corrosion->inspection_id.'/corrosions/'.$corrosion->id, 'private')
        ]);

        return $this->showOne($file);
    }

    /**
     * @OA\Get(
     *     path="/corrosions/{corrosion}/files/{file}",
     *     summary="Muestra un archivo asociado a una corrosión",
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
     *         description="Muestra un archivo asociado a una corrosión.",
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
    public function show(Corrosion $corrosion, File $file)
    {
        if (!$corrosion->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(__('El archivo no existe o no esta asociado a esta corrosión.'), 409);
        }

        return $this->show_file($file->path);
    }

    /**
     * @OA\Put(
     *     path="/corrosions/{corrosion}/files/{file}",
     *     summary="Actualiza un archivo asociado a una corrosión",
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
     *         description="Actualiza un archivo asociado a una corrosión.",
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
    public function update(Request $request, Corrosion $corrosion, File $file)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (!$corrosion->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(__('El archivo no existe o no esta asociado a esta corrosión.'), 409);
        }

        if ($corrosion->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes actualizar la imágen en está corrosión porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        $this->delete_file_only($file->path);

        $file->path = $this->store_file($request->file('file'), 'inspections/'.$corrosion->inspection_id.'/corrosions/'.$corrosion->id, 'private');

        $file->save();

        return $this->showOne($file);
    }

    /**
     * @OA\Delete(
     *     path="/corrosions/{corrosion}/files/{file}",
     *     summary="Elimina un archivo asociado a una corrosión",
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
     *         description="Elimina un archivo asociado a una corrosión.",
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
    public function destroy(Corrosion $corrosion, File $file)
    {
        if (!$corrosion->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(__('El archivo no existe o no esta asociado a esta corrosión.'), 409);
        }

        if ($corrosion->inspection->status_id != Status::abbreviation('gen-act')->id) {
            return $this->errorResponse(__('No puedes eliminar el archivo de está corrosión porque a la inspección a la que pertenece ya fue finalizada.'), 409);
        }

        $this->delete_file($file);

        return $this->showOne($file);
    }
}
