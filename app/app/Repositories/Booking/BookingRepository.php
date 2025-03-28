<?php

namespace App\Repositories\Booking;

use App\Models\Booking;
use Illuminate\Support\Arr;

Class BookingRepository
{
    public function create(array $data) : Booking
    {
        $data['start_at'] = $data['start_time'];
        $data['end_at'] = $data['end_time'];
        
        $booking = Booking::create(Arr::except($data, ['start_time', 'end_time']));

        return $booking;
    }



    public function getById(int $id) : Booking
    {
        return Booking::findOrFail($id);
    }



    public function delete(int $id) : void
    {
        $booking = $this->getById(id: $id);

        $booking->delete();
    }
}