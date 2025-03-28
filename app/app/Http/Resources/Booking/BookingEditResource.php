<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\Resource\ResourceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'resource' => new ResourceResource($this->resource),
                'user' => [
                    'name' => $this->user->name,
                    'id' => $this->user->id,
                ],
                'strat_time' => $this->start_at,
                'end_time' => $this->end_at,
            ],
            'success' => 1
        ];
    }
}
