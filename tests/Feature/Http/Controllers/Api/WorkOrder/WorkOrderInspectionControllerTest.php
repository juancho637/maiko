<?php

namespace Tests\Feature\Http\Controllers\Api\WorkOrder;

use App\WorkOrder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkOrderInspectionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function testStoreInspectionIncomplete()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];
        $inspector = $this->user($token)['data'];

        $work_order = WorkOrder::all()->random(1)->first();
        $latitude = $this->faker->latitude($min = -90, $max = 90);
        $longitude = $this->faker->longitude($min = -180, $max = 180);
        $date = now()->toDateString('Y-m-d');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/v1/work_orders/'.$work_order->id.'/inspections', [
            'user_id' => $inspector['id'],
            'latitude' => $latitude,
            'longitude' => $longitude,
            'date' => $date,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'status' => 1,
                'user' => $inspector['id'],
                'work_order' => $work_order->id,
                'city' => null,
                'tank' => null,
                'date' => $date,
                'address' => null,
                'light_intensity' => null,
                'humidity' => null,
                'temperature' => null,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'observation' => null,
            ]
        ]);
    }

    public function testStoreInspectionWithClient()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];
        $inspector = $this->user($token)['data'];

        $work_order = WorkOrder::all()->random(1)->first();

        $client = $work_order->company->clients()->get()->random(1)->first();
        $date = now()->toDateString('Y-m-d');
        $latitude = $this->faker->latitude($min = -90, $max = 90);
        $longitude = $this->faker->longitude($min = -180, $max = 180);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/v1/work_orders/'.$work_order->id.'/inspections', [
            'user_id' => $inspector['id'],
            'client_id' => $client->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'date' => $date,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'status' => 1,
                'user' => $inspector['id'],
                'work_order' => $work_order->id,
                'city' => $client->city_id,
                'tank' => null,
                'date' => $date,
                'address' => $client->address,
                'light_intensity' => null,
                'humidity' => null,
                'temperature' => null,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'observation' => null,
            ]
        ]);
    }

    public function testStoreInspectionWithTank()
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

        $date = now()->toDateString('Y-m-d');
        $latitude = $this->faker->latitude($min = -90, $max = 90);
        $longitude = $this->faker->longitude($min = -180, $max = 180);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/v1/work_orders/'.$work_order->id.'/inspections', [
            'user_id' => $inspector['id'],
            'tank_id' => $tank->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'date' => $date,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'status' => 1,
                'user' => $inspector['id'],
                'work_order' => $work_order->id,
                'city' => $tank->client->city_id,
                'tank' => $tank->id,
                'date' => $date,
                'address' => $tank->client->address,
                'light_intensity' => null,
                'humidity' => null,
                'temperature' => null,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'observation' => null,
            ]
        ]);
    }

    public function testStoreInspectionWithComplete()
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

        $date = now()->toDateString('Y-m-d');
        $latitude = $this->faker->latitude($min = -90, $max = 90);
        $longitude = $this->faker->longitude($min = -180, $max = 180);
        $light_intensity = ''.$this->faker->numberBetween($min = 20, $max = 30);
        $humidity = ''.$this->faker->numberBetween($min = 20, $max = 30);
        $temperature = ''.$this->faker->numberBetween($min = 20, $max = 30);
        $observation = $this->faker->sentence(5, false);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/v1/work_orders/'.$work_order->id.'/inspections', [
            'user_id' => $inspector['id'],
            'tank_id' => $tank->id,
            'client_id' => $tank->client->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'light_intensity' => $light_intensity,
            'humidity' => $humidity,
            'temperature' => $temperature,
            'observation' => $observation,
            'date' => $date,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'status' => 1,
                'user' => $inspector['id'],
                'work_order' => $work_order->id,
                'city' => $tank->client->city_id,
                'tank' => $tank->id,
                'date' => $date,
                'address' => $tank->client->address,
                'light_intensity' => $light_intensity,
                'humidity' => $humidity,
                'temperature' => $temperature,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'observation' => $observation,
            ]
        ]);
    }
}
