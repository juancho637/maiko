<?php

namespace Tests\Feature\Http\Controllers\Api\Corrosion;

use App\Inspection;
use Tests\TestCase;
use App\Traits\StorageDriver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CorrosionFileControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, StorageDriver;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->seed();
    }

    public function testStoreFileCorrosion()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];

        $inspection = Inspection::all()->random(1)->first();
        $corrosion = $inspection->corrosions()->first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('POST', '/api/v1/corrosions/'.$corrosion->id.'/files', [
            'file' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertStatus(200);
    }

    public function testUpdateFileCorrosion()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];

        $inspection = Inspection::all()->random(1)->first();
        $corrosion = $inspection->corrosions()->first();

        $file = $corrosion->files()->create([
            'path' => $this->store_file(UploadedFile::fake()->image('avatar.jpg'), 'inspections/'.$corrosion->inspection_id.'/corrosions/'.$corrosion->id, 'private')
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('PUT', '/api/v1/corrosions/'.$corrosion->id.'/files/'.$file->id, [
            'file' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'id' => $file->id,
            ]
        ]);
    }

    public function testDestroyFileCorrosion()
    {
        $token = $this->login('super@maiko.com')->decodeResponseJson()['access_token'];

        $inspection = Inspection::all()->random(1)->first();
        $corrosion = $inspection->corrosions()->first();

        for ($i=0; $i < 6; $i++) {
            $corrosion->files()->create([
                'path' => $this->store_file(UploadedFile::fake()->image('avatar.jpg'), 'inspections/'.$corrosion->inspection_id.'/corrosions/'.$corrosion->id, 'private')
            ]);
        }

        $file = $corrosion->files()->first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->json('DELETE', '/api/v1/corrosions/'.$corrosion->id.'/files/'.$file->id);

        $response->assertStatus(200)->assertJson([
            'data' => [
                'id' => $file->id,
            ]
        ]);
    }
}
