<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'type_id',
    ];



    /**
     * RELATIONS
     */



    public function type()
    {
        return $this->hasOne(\App\Models\ResourceType::class, 'id', 'type_id');
    }



    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'resource_id', 'id');
    }
}
