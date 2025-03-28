<?php

namespace Tests\Feature;

use App\Models\ResourceType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Support\Str;

class ResourceTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->withoutMiddleware()
            ->json('GET', '/api/resources')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                        'type'
                    ],
                ],
                'success'
            ]);
    }



    public function testStore(): void
    {
        $type = ResourceType::create([
            'name' => Str::random(10),
        ]);

        $payload = [
            'name' => Str::random(10),
            'description' => Str::random(50),
            'type' => $type->id,
        ];

        $this->withoutMiddleware()
            ->json('post', 'api/resources', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $payload['type_id'] = $type->id;
        unset($payload['type']);

        $this->assertDatabaseHas('resources', $payload);
    }
}
