<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'meal_date',
        'meal_type',
        'main_menu',
        'soup',
        'sub_menu',
        'fruits',
    ];
}
