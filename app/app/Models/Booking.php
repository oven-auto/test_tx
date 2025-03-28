<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'resource_id',
        'user_id',
        'start_at',
        'end_at',
    ];



    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];



    /**
     * RELATIONS
     */



    public function resource()
    {
        return $this->hasOne(\App\Models\Resource::class, 'id', 'resource_id');
    }



    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }
}
