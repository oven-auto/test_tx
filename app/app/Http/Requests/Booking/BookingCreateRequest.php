<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      required={"resource_id", "user_id", "start_time", "end_time"}
 * )
 */ 
class BookingCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    
    
    /**
     * @OA\Property(format="integer", description="Идентификатор ресурса", property="resource_id", type="integer"),
     * @OA\Property(format="integer", description="Идентификатор пользователя", property="user_id", type="integer"),
     * @OA\Property(format="string", description="Начало бронирования", property="start_time", type="string"),
     * @OA\Property(format="string", description="Конец бронирования", property="end_time", type="string"),
     */
    public function rules(): array
    {
        return [
            'resource_id' => 'required|exists:resources,id',
            'user_id' => 'required|exists:users,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ];
    }
}
