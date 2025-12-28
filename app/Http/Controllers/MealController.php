<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Meal;
use Illuminate\Http\Request;

use function Symfony\Component\Clock\now;

class MealController extends Controller
{
    

    public function create(Request $request)
    {
        $mealDate = $request->meal_date ?? Carbon::now()->toDateString();

        $usedMealTypes = Meal::whereDate('meal_date', $mealDate)
            ->pluck('meal_type')
            ->toArray();

        // Check if all meal types are already set
        $mealTypes = ['breakfast', 'lunch', 'dinner'];
        $allMealsSet = empty(array_diff($mealTypes, $usedMealTypes)) ; // true if all are set

        return view('meals.create', compact('usedMealTypes', 'mealDate', 'allMealsSet'));
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

    public function edit(Meal $meal)
    {
        return view('meals.edit', compact('meal'));
    }

    public function update(Request $request, Meal $meal)
    {
        $request->validate([
            'main_menu' => 'required',
            'soup' => 'required',
            'sub_menu' =>'required',
            'fruits' => 'required',
        ]);

        $meal->update($request->all());

        return redirect()->route('guests.index')->with('success', 'Meal updated successfully!');
    }
}
