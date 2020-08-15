<?php

use App\Dent;
use App\Question;
use App\Corrosion;
use App\Inspection;
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

        Corrosion::all()->each(function ($corrosion) {
            Question::byModule(Question::MODULE_CORROSION)
                ->get()
                ->each(function ($question) use ($corrosion) {
                    $responses = explode(',', $question->possible_response);
                    $rand_key = array_rand($responses);
                    $corrosion->answers()->create([
                        'question_id' => $question->id,
                        'value' => $responses[$rand_key],
                    ]);
                });
        });

        Dent::all()->each(function ($dent) {
            Question::byModule(Question::MODULE_DENT)
                ->get()
                ->each(function ($question) use ($dent) {
                    $responses = explode(',', $question->possible_response);
                    $rand_key = array_rand($responses);
                    $dent->answers()->create([
                        'question_id' => $question->id,
                        'value' => $responses[$rand_key],
                    ]);
                });
        });
    }
}
