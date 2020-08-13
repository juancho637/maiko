<?php

namespace App\Http\Controllers\Dashboard\Inspection;

use App\File;
use App\Inspection;
use App\Traits\StorageDriver;
use App\Http\Controllers\Controller;

class InspectionFileController extends Controller
{
    use StorageDriver;

    public function __construct()
    {
        $this->middleware('can:view inspection')->only('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection, File $file)
    {
        if (!$inspection->files()->where('id', $file->id)->exists()) {
            return $this->errorResponse(
                __('El archivo no existe o no esta asociado a esta inspección.'),
                404
            );
        }

        return $this->show_file($file->path);
    }
}
