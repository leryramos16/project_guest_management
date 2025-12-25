<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function guests()
    {
         return $this->belongsToMany(Guest::class, 'guest_room');
    }
}
