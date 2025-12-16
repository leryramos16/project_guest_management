<?php

namespace App\Http\Controllers;


use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    

    public function create()
    {
        return view('meals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'meal_date' => 'required|date',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'main_menu' => 'required|string|max:255',
            'soup' => 'required|string|max:255',
            'sub_menu' => 'required|string|max:255',
            'fruits' => 'required|string|max:255',
        ]);

        Meal::create($validated);

        return back()->with('success', 'Meal menu saved successfully.');
    }
}
