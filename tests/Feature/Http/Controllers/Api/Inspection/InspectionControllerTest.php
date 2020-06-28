<?php

namespace Tests\Feature\Http\Controllers\Api\Inspection;

use App\Inspection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InspectionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

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

        $humidity = ''.$this->faker->numberBetween($min = 20, $max = 30);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('PUT', '/api/v1/inspections/'.$inspection->id, [
            'humidity' => $humidity,
            'tank_id' => $tank->id,
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
}
