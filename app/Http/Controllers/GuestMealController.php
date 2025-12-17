<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use App\Models\GuestMeal;
use Illuminate\Http\Request;


class GuestMealController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'guest_ids' => 'required|array',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'meal_date' => 'required|date',
        ]);

        // Get the meal record for today
         $meal = Meal::where('meal_date', $request->meal_date)
        ->where('meal_type', $request->meal_type)
        ->firstOrFail();

    // Record each selected guest
    foreach ($request->guest_ids as $guestId) {
        GuestMeal::updateOrCreate(
            [
                'guest_id' => $guestId,
                'meal_id' => $meal->id,
            ]
        );
    }

    return back()->with('success', 'Meals recorded successfully!');
    }
}
