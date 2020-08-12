<?php

namespace Tests\Feature\Http\Controllers\Api\Inspection;

use App\Inspection;
use App\Question;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InspectionDentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->seed();
    }

    public function testStoreDent()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];

        $inspection = Inspection::all()->random(1)->first();

        $large = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $width = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $average = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $answers = [];
        // $answers[] = ['question_id' => 'asdasd', 'answer' => 'asdasd'];
        // $answers[] = ['answer' => 'asdasd', 'question_id' => 'asdasd'];

        Question::byModule(Question::MODULE_DENT)
            ->get()
            ->each(function ($question) use (&$answers) {
                $possible_answers = explode(',', $question->possible_response);

                $answers[] = [
                    'question_id' => $question->id,
                    'answer' => $possible_answers[array_rand($possible_answers)],
                ];
            });

        // unset($answers[2]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/v1/inspections/' . $inspection->id . '/dents', [
            'large' => $large,
            'width' => $width,
            'average' => $average,
            'answers' => $answers,
            'files' => [
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
            ],
        ]);

        // dd($response->decodeResponseJson());

        $response->assertStatus(200)->assertJson([
            'data' => [
                'large' => $large,
                'width' => $width,
                'average' => $average,
            ]
        ]);
    }
}
