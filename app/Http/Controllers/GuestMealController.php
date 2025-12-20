<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use App\Models\GuestMeal;
use Illuminate\Http\Request;


class GuestMealController extends Controller
{
    public function index(Request $request)
    {   
        

        // Get all guest meals with guest and meal info
        $guestMeals = GuestMeal::with(['guest', 'meal'])
            ->orderBy('meal_id')
            ->get();
        $query = GuestMeal::with(['guest', 'meal']);

        // search guest logic
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('guest', function($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%');
            });
        }

        // filter date logic
        if ($request->filled('meal_date')) {
            $query->whereHas('meal', function ($q) use($request) {
                $q->whereDate('meal_date', $request->meal_date);
            });
        }


        $guestMeals = $query->orderBy('meal_id', 'desc')->get();

        return view('guest_meals.index', compact('guestMeals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_ids' => 'required|array|min:1',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'meal_date' => 'required|date',
        ], [
            'guest_ids.required' => 'Please select at least one guest.',
            'guest_ids.min' => 'Please select at least one guest.',
        ]);

        //  Check if menu exists FIRST
        $meal = Meal::where('meal_type', $request->meal_type)
        ->whereDate('meal_date', $request->meal_date)
        ->first();

        if (! $meal) {
        return back()
            ->withErrors([
                'meal_type' => 'Selected meal has no menu set for today.'
            ])
            ->withInput();
    }

    $created = false;

    // Record each selected guest
    foreach ($request->guest_ids as $guestId) {
        $guestMeal = GuestMeal::firstOrCreate(
            [
                'guest_id' => $guestId,
                'meal_id' => $meal->id,
            ]
        );

        if ($guestMeal->wasRecentlyCreated) {
            $created = true;
        }
    }

    if ($created) {
        return back()->with('success', 'Meals recorded successfully!');
    }

    return back()->with('info', 'Selected guests already have meals recorded!');
    }
}
