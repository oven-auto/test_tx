<?php

namespace App\Repositories\ResourceType;

use App\Models\ResourceType;

Class ResourcesTypeRepository
{
    public function getById(int $id)
    {
        return ResourceType::findOrFail($id);
    }



    public function getAll()
    {
        return ResourceType::get();
    }



    public function create(array $data)
    {
        $type = ResourceType::create($data);

        return $type;
    }



    public function update(int $id, array $data)
    {
        $type = $this->getById(id: $id);

        $type->fill($data);

        if($type->isDirty())
            $type->save();

        return $type;
    }
}