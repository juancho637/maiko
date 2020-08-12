<?php

namespace Tests\Feature\Http\Controllers\Api\Inspection;

use App\Question;
use App\Corrosion;
use App\Inspection;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InspectionCorrosionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->seed();
    }

    public function testStoreCorrosion()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];

        $inspection = Inspection::all()->random(1)->first();

        $area = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $corrosion_type = $this->faker->randomElement(Corrosion::CORROSION_TYPES);
        $remaining_thickness = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $large = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $thickness = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $depth = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $answers = [];
        // $answers[] = ['question_id' => 'asdasd', 'answer' => 'asdasd'];
        // $answers[] = ['answer' => 'asdasd', 'question_id' => 'asdasd'];

        Question::byModule(Question::MODULE_CORROSION)
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
        ])->json('POST', '/api/v1/inspections/' . $inspection->id . '/corrosions', [
            'area' => $area,
            'corrosion_type' => $corrosion_type,
            'remaining_thickness' => $remaining_thickness,
            'large' => $large,
            'thickness' => $thickness,
            'depth' => $depth,
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
                'area' => $area,
                'corrosion_type' => $corrosion_type,
                'remaining_thickness' => $remaining_thickness,
                'large' => $large,
                'thickness' => $thickness,
                'depth' => $depth,
            ]
        ]);
    }
}
