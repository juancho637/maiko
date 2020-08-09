<?php

namespace Tests\Feature\Http\Controllers\Api\Corrosion;

use App\Corrosion;
use App\Inspection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CorrosionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function testUpdateCorrosion()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];

        $inspection = Inspection::all()->random(1)->first();
        $corrosion = $inspection->corrosions()->first();

        $area = (string)$this->faker->numberBetween($min = 20, $max = 30);
        $corrosion_type = $this->faker->randomElement(Corrosion::CORROSION_TYPES);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('PUT', '/api/v1/corrosions/' . $corrosion->id, [
            'area' => $area,
            'corrosion_type' => $corrosion_type,
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'area' => $area,
                'corrosion_type' => $corrosion_type,
            ]
        ]);
    }
}
