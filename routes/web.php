<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestMealController;
use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Route;




Route::get('/', [GuestController::class, 'index']);
Route::resource('/guests', GuestController::class);
Route::get('/meals/create', [MealController::class, 'create'])->name('meals.create');
Route::post('/meals', [MealController::class, 'store'])->name('meals.store');
Route::post('/guest-meals', [GuestMealController::class, 'store'])->name('guest_meals.store');
Route::get('/guest-meals', [GuestMealController::class, 'index'])->name('guest_meals.index');
Route::get('/guests/{guest}/meals', [GuestMealController::class, 'show'])->name('guests.meals.show');
// route ng edit meals per meal type
Route::get('/meals/{meal}/edit', [MealController::class, 'edit'])->name('meals.edit');
Route::put('meals/{meal}', [MealController::class, 'update'])->name('meals.update');



