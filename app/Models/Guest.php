<?php

namespace App\Models;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
    'full_name',
    'check_in_date',
    'check_out_date',
    'is_group_leader',
];


    /**
     * One guest (leader) can have many rooms
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'guest_room');
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
            ->whereNull('checked_out_at') // not manually checked out
            ->whereDate('check_out_date', '>=', $today);
            
    }


}
