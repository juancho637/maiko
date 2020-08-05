<?php

use App\Inspection;
use App\Question;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inspection::all()->each(function ($inspection) {
            Question::byModule(Question::MODULE_EXTERNAL)
                ->get()
                ->each(function ($question) use ($inspection) {
                    $responses = explode(',', $question->possible_response);
                    $rand_key = array_rand($responses);
                    $inspection->answers()->create([
                        'question_id' => $question->id,
                        'value' => $responses[$rand_key],
                    ]);
                });
        });
    }
}
