<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      required={"name", "type"}
 * )
 */ 
class ResourceCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    

    /**
     * @OA\Property(format="string", description="Название ресурса", property="name", type="string"),
     * @OA\Property(format="string", description="Описание ресурса", property="description", type="string"),
     * @OA\Property(format="string", description="Типа ресурса", property="type", type="string"),
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'sometimes|max:5000|string',
            'type' => 'required|exists:resource_types,id'
        ];
    }
}
