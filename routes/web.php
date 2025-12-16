<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;




Route::get('/', [GuestController::class, 'index']);
Route::resource('/guests', GuestController::class);



