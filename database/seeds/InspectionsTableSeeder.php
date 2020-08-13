<?php

use App\WorkOrder;
use Carbon\Carbon;
use App\Inspection;
use App\Traits\StorageDriver;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class InspectionsTableSeeder extends Seeder
{
    use StorageDriver;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkOrder::all()->each(function ($work_order) {
            $client = $work_order->company->clients()->get()->random(1)->first();

            factory(Inspection::class, 1)->create([
                'work_order_id' => $work_order->id,
                'city_id' => $client->city_id,
                'tank_id' => $client->tanks()->get()->random(1)->first()->id,
                'date' => Carbon::createFromFormat('Y-m-d', $work_order->start)->addDay(1)->toDateString(),
                'address' => $client->address,
            ])->each(function ($inspection) {
                for ($i = 1; $i <= 15; $i++) {
                    $inspection->files()->create([
                        'path' => $this->store_file(UploadedFile::fake()->image('avatar.jpg'), 'inspections/' . $inspection->id, 'private')
                    ]);
                }
            });
        });
    }
}
