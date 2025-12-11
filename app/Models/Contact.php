<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
    'first_name',
    'middle_name',
    'last_name',
    'phone',
    'email',
    'facebook',
    'instagram',
    'tiktok',
    'twitter',
    'image',
];



    public function getFullNameAttribute()
    {
        return trim($this->first_name . '' . ($this->middle_name ? $this->middle_name . '' : '') . $this->last_name);
    }
}
