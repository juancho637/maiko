<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Question::MODULES as $module) {
            factory(Question::class, 7)->create([
                'module' => $module,
            ]);
        }
    }
}
