<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Route;




Route::get('/', [GuestController::class, 'index']);
Route::resource('/guests', GuestController::class);
Route::get('/meals/create', [MealController::class, 'create'])->name('meals.create');
Route::post('/meals', [MealController::class, 'store'])->name('meals.store');




