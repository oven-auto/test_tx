<?php

namespace Tests\Feature;

use App\Models\Resource;
use App\Models\ResourceType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Support\Str;

class BookingTest extends TestCase
{
    public function testStore(): void
    {
        $type = ResourceType::create([
            'name' => Str::random(10),
        ]);

        $resource = Resource::create([
            'name' => Str::random(10),
            'description' => Str::random(50),
            'type_id' => $type->id,
        ]);

        $user = User::create([
            'name' => 1,
            'email' => 'test@test.ru',
            'password' => sha1(123456),
        ]);

        $payload = [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => '2022-02-03 11:11',
            'end_time' => '2022-02-03 11:52',
        ];

        $response = $this->withoutMiddleware()
            ->json('post', '/api/bookings/', $payload)
            ->assertStatus(Response::HTTP_CREATED);
    }
}
