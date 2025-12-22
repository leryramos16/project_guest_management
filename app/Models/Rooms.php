<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    public function guest()
    {
         return $this->hasOne(Guest::class);
    }
}
