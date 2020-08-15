<?php

use App\Corrosion;
use App\Inspection;
use App\Traits\StorageDriver;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class CorrosionsTableSeeder extends Seeder
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
            factory(Corrosion::class, 2)->create([
                'inspection_id' => $inspection->id,
            ])->each(function ($corrosion) {
                $corrosion->files()->create([
                    'path' => $this->store_file(UploadedFile::fake()->image('avatar.jpg'), 'inspections/' . $corrosion->inspection_id . '/corrosions/' . $corrosion->id, 'private')
                ]);
                $corrosion->files()->create([
                    'path' => $this->store_file(UploadedFile::fake()->image('avatar.jpg'), 'inspections/' . $corrosion->inspection_id . '/corrosions/' . $corrosion->id, 'private')
                ]);
            });
        });
    }
}
