<?php

namespace App\Http\Controllers\Dashboard\Dent;

use App\Dent;
use App\File;
use App\Traits\StorageDriver;
use App\Http\Controllers\Controller;

class DentFileController extends Controller
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('can:view dent')->only('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Dent $dent, File $file)
    {
        if (!$dent->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(
                __('El archivo no existe o no esta asociado a esta abolladura.'),
                404
            );
        }

        return $this->show_file($file->path);
    }
}
