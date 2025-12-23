<?php

namespace App\Models;

use App\Models\Rooms;
use Carbon\Carbon;
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

    public function guestMeals()
    {
        return $this->hasMany(GuestMeal::class);
    }

    public function scopeActive($query)
    {
        $today = Carbon::today();

        return $query 
            ->whereDate('check_in_date', '<=', $today)
            ->whereDate('check_out_date', '>=', $today);
    }


}
