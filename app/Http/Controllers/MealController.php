<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class MealController extends Controller
{
    

    public function create()
    {
        $today = Carbon::now()->toDateString();

        $usedMealTypes = Meal::whereDate('meal_date', $today)
            ->pluck('meal_type')
            ->toArray();

        return view('meals.create', compact('usedMealTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'meal_date' => 'required|date',
            'meal_type' => 'required|string|unique:meals,meal_type,NULL,id,meal_date,' . $request->meal_date,
            'main_menu' => 'required|string|max:255',
            'soup' => 'required|string|max:255',
            'sub_menu' => 'required|string|max:255',
            'fruits' => 'required|string|max:255',
        ]);

        Meal::create($validated);

        return back()->with('success', 'Meal menu saved successfully.');
    }
}
