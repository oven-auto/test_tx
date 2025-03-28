<?php

namespace App\Repositories\Resource;

use App\Models\Resource;

Class ResourceRepository
{
    public function getAll()
    {
        return Resource::simplePaginate(20);
    }



    public function create(array $data)
    {
        $data['type_id'] = $data['type'];
        
        unset($data['type']);

        $resource = Resource::create($data);

        return $resource;
    }



    public function getById(int $id)
    {
        $resource = Resource::with(['type', 'bookings'])->findOrFail($id);

        return $resource;
    }
}