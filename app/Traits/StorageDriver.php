<?php

namespace App\Traits;

use App\File;
use Illuminate\Support\Facades\Storage;

trait StorageDriver
{
    public function store_file($file, $path, $visibility = 'public')
    {
        $storagePath = Storage::put($path, $file, $visibility);

        if ($visibility === 'private') {
            return $storagePath;
        }

        return Storage::url($storagePath);
    }

    public function show_file($path)
    {
        $file = Storage::path($path);

        return response()->file($file);
    }

    public function delete_file(File $file)
    {
        $this->delete_file_only($file->path);

        $file->delete();
    }

    public function delete_file_only($file)
    {
        if (Storage::exists($file)) {
            Storage::delete($file);
        }
    }
}
