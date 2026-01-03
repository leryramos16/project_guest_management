<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class GuestMeal extends Model
{
    // Allow mass assignment for these columns
    protected $fillable = [
        'guest_id',
        'meal_id',

        //  SNAPSHOT FIELDS
        'meal_date',
        'meal_type',
        'main_menu',
        'soup',
        'sub_menu',
        'fruits',
        
    ];

    // Optional: define relationships

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

   
}
