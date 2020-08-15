<?php

namespace App\Http\Controllers\Dashboard\Corrosion;

use App\File;
use App\Corrosion;
use App\Traits\StorageDriver;
use App\Http\Controllers\Controller;

class CorrosionFileController extends Controller
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('can:view corrosion')->only('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Corrosion $corrosion, File $file)
    {
        if (!$corrosion->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(
                __('El archivo no existe o no esta asociado a esta inspección.'),
                404
            );
        }

        return $this->show_file($file->path);
    }
}
