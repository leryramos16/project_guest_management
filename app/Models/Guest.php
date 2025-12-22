<?php

namespace App\Models;

use App\Models\Rooms;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
    'full_name',
    'room_id',
    'check_in_date',
    'check_out_date',
];
    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }



}
