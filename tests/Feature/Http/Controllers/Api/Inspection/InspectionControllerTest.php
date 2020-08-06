<?php

namespace Tests\Feature\Http\Controllers\Api\Inspection;

use App\Status;
use App\Question;
use App\WorkOrder;
use Carbon\Carbon;
use App\Inspection;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InspectionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->seed();
    }

    public function testUpdateInspection()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];

        $inspection = Inspection::all()->random(1)->first();

        $tank = $inspection
            ->work_order
            ->company
            ->clients()
            ->with('tanks')
            ->get()
            ->pluck('tanks')
            ->collapse()
            ->random(1)
            ->first();

        $humidity = '' . $this->faker->numberBetween($min = 20, $max = 30);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('PUT', '/api/v1/inspections/' . $inspection->id, [
            'humidity' => $humidity,
            'tank' => $tank->id,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'city' => $tank->client->city_id,
                'tank' => $tank->id,
                'address' => $tank->client->address,
                'humidity' => $humidity,
            ]
        ]);
    }

    public function testCompleteInspectionApproved()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];
        $inspector = $this->user($token)['data'];

        $work_order = WorkOrder::all()->random(1)->first();

        $tank = $work_order
            ->company
            ->clients()
            ->with('tanks')
            ->get()
            ->pluck('tanks')
            ->collapse()
            ->random(1)
            ->first();

        $inspection = factory(Inspection::class)->create([
            'user_id' => $inspector['id'],
            'work_order_id' => $work_order->id,
            'city_id' => $tank->client->city_id,
            'tank_id' => $tank->id,
            'date' => Carbon::now()->toDateString(),
            'address' => $tank->client->address,
        ]);

        $inspection->accesories()->create([
            'inspection_id' => $inspection->id,
            'name' => 'asd',
        ]);

        Question::byModule(Question::MODULE_EXTERNAL)
            ->get()
            ->each(function ($question) use ($inspection) {
                $inspection->answers()->create([
                    'question_id' => $question->id,
                    'value' => array_rand(explode(',', $question->possible_response)),
                ]);
            });

        $status = Status::abbreviation('insp-pass');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/v1/inspections/' . $inspection->id . '/complete', [
            'status' => $status->id,
            'files' => [
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg')
            ]
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'id' => $inspection->id,
                'status' => $status->id,
            ]
        ]);
    }

    public function testCompleteInspectionRejected()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];
        $inspector = $this->user($token)['data'];

        $work_order = WorkOrder::all()->random(1)->first();

        $tank = $work_order
            ->company
            ->clients()
            ->with('tanks')
            ->get()
            ->pluck('tanks')
            ->collapse()
            ->random(1)
            ->first();

        $inspection = factory(Inspection::class)->create([
            'user_id' => $inspector['id'],
            'work_order_id' => $work_order->id,
            'city_id' => $tank->client->city_id,
            'tank_id' => $tank->id,
            'date' => Carbon::now()->toDateString(),
            'address' => $tank->client->address,
        ]);

        $inspection->accesories()->create([
            'inspection_id' => $inspection->id,
            'name' => 'asd',
        ]);

        Question::byModule(Question::MODULE_EXTERNAL)
            ->get()
            ->each(function ($question) use ($inspection) {
                $inspection->answers()->create([
                    'question_id' => $question->id,
                    'value' => array_rand(explode(',', $question->possible_response)),
                ]);
            });

        $status = Status::abbreviation('insp-refu');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/v1/inspections/' . $inspection->id . '/complete', [
            'status' => $status->id,
            'files' => [
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg')
            ],
            'criterias' => [
                'criteria one',
                'criteria two',
            ],
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'id' => $inspection->id,
                'status' => $status->id,
            ]
        ]);
    }
}
