<?php

namespace App\Traits;

use App\File;
use Illuminate\Support\Facades\Storage;

trait StorageDriver
{
    public function store_file($file, $path, $visibility = 'public')
    {
        Storage::put($path, $file, $visibility);

        if ($visibility === 'private') {
            return $path;
        }

        return Storage::url($path);
    }

    public function show_file($path)
    {
        $file = storage_path($path);

        return response()->file($file);
        // return response()->stream(function() use ($file) {
        //     echo $file;
        // }, 200, ['Content-Type' => 'image/jpeg',]);
    }

    public function delete_file(File $file)
    {
        $this->delete_file_only($file->path);

        $file->delete();
    }

    public function delete_file_only($file)
    {
        if(Storage::exists($file)) {
            Storage::delete($file);
        }
    }
}
