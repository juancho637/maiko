<?php

use App\Dent;
use App\Inspection;
use App\Traits\StorageDriver;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class DentsTableSeeder extends Seeder
{
    use StorageDriver;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inspection::all()->each(function ($inspection) {
            factory(Dent::class, 2)->create([
                'inspection_id' => $inspection->id,
            ])->each(function ($dent) {
                $dent->files()->create([
                    'path' => $this->store_file(UploadedFile::fake()->image('avatar.jpg'), 'inspections/' . $dent->inspection_id . '/dents/' . $dent->id, 'private')
                ]);
                $dent->files()->create([
                    'path' => $this->store_file(UploadedFile::fake()->image('avatar.jpg'), 'inspections/' . $dent->inspection_id . '/dents/' . $dent->id, 'private')
                ]);
            });
        });
    }
}
