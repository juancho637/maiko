<?php

use App\Company;
use App\WorkOrder;
use Illuminate\Database\Seeder;

class WorkOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::all()->each(function ($company) {
            factory(WorkOrder::class, 10)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}
