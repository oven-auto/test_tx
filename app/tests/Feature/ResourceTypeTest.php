<?php

namespace Tests\Feature;

use App\Models\ResourceType;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Support\Str;

class ResourceTypeTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->withoutMiddleware()
            ->json('GET', '/api/resourcetypes')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                    ],
                ],
                'success'
            ]);
    }



    public function testStore()
    {
        $payload = [
            'name' => Str::random(10),
        ];

        $this->withoutMiddleware()
            ->json('post', 'api/resourcetypes', $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('resource_types', $payload);
    }



    public function testShow()
    {
        $type = ResourceType::create([
            'name' => Str::random(10),
        ]);

        $this->withoutMiddleware()
            ->json('get', 'api/resourcetypes/'.$type->id)
            ->assertStatus(Response::HTTP_OK);
    }



    public function testUpdate()
    {
        $type = ResourceType::create([
            'name' => Str::random(10),
        ]);

        $payload = [
            'name' => Str::random(10),
        ];

        $this->withoutMiddleware()
            ->json('patch', 'api/resourcetypes/'.$type->id, $payload)
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('resource_types', $payload);
    }
}
