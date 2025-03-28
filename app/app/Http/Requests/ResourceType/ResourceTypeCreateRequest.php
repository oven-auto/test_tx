<?php

namespace App\Http\Requests\ResourceType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      required={"name"}
 * )
 */ 
class ResourceTypeCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }



    /**
     * @OA\Property(format="string", description="Название типа ресурса", property="name", type="string"),
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
