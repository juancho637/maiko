<?php

namespace Tests\Feature\Http\Controllers\Api\Inspection;

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

        $area = $this->faker->numberBetween($min = 20, $max = 30);
        $corrosion_type = $this->faker->randomElement(Corrosion::CORROSION_TYPES);
        $remaining_thickness = $this->faker->numberBetween($min = 20, $max = 30);
        $large = $this->faker->numberBetween($min = 20, $max = 30);
        $thickness = $this->faker->numberBetween($min = 20, $max = 30);
        $depth = $this->faker->numberBetween($min = 20, $max = 30);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/v1/inspections/'.$inspection->id.'/corrosions', [
            'area' => $area,
            'corrosion_type' => $corrosion_type,
            'remaining_thickness' => $remaining_thickness,
            'large' => $large,
            'thickness' => $thickness,
            'depth' => $depth,
            'files' => [
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
                UploadedFile::fake()->image('avatar.jpg'),
            ],
        ]);

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
