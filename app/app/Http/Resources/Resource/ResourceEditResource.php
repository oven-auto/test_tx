<?php

namespace App\Http\Resources\Resource;

use App\Http\Resources\ResourceType\ResourceTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceEditResource extends JsonResource
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
                'name' => $this->name,
                'description' => $this->description,
                'type' => new ResourceTypeResource($this->type),
            ],
            'success' => 1,
        ];
    }
}
