<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use App\Models\GuestMeal;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;


class GuestMealController extends Controller
{
    public function index(Request $request)
{
    //  Start ONE query only
    $query = GuestMeal::with(['guest.rooms', 'meal']);

    /* ================= SEARCH ================= */
    if ($request->filled('search')) {
        $query->whereHas('guest', function ($q) use ($request) {
            $q->where('full_name', 'like', '%' . $request->search . '%');
        });
    }

    /* ================= DATE FILTER ================= */
    if ($request->filled('meal_date')) {
        $query->whereHas('meal', function ($q) use ($request) {
            $q->whereDate('meal_date', $request->meal_date);
        });
    } else {
        //  Default: LAST 7 DAYS
        $query->whereHas('meal', function ($q) {
            $q->whereDate('meal_date', '>=', Carbon::now()->subDays(7));
        });
    }

    /* ================= ORDER BY MEAL DATE ================= */
    $query->orderByDesc(
        Meal::select('meal_date')
            ->whereColumn('meals.id', 'guest_meals.meal_id')
    );

    /* ================= PAGINATION ================= */
    $guestMeals = $query
        ->paginate(10)           
        ->withQueryString();     

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
        $guestMeal = GuestMeal::create(
            [
                'guest_id' => $guestId,
                'meal_id' => $meal->id,

                // Snapshot
                'meal_date' => $meal->meal_date,
                'meal_type' => $meal->meal_type,
                'main_menu' => $meal->main_menu,
                'soup'      => $meal->soup,
                'sub_menu'  => $meal->sub_menu,
                'fruits'    => $meal->fruits,
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

    public function show(Guest $guest)
    {
         // Load meals related to this guest
         $guestMeals = $guest->guestMeals()
            ->orderByDesc('meal_date')
            ->paginate(20);

            return view('guest_meals.show', compact('guest', 'guestMeals'));
    }

    
    public function undo(Guest $guest, $mealType)
{
    $today = now()->toDateString();

    // Find today's meal record for this guest and meal type
    $guestMeal = GuestMeal::where('guest_id', $guest->id)
        ->whereHas('meal', function ($q) use ($mealType, $today) {
            $q->where('meal_type', $mealType)
              ->whereDate('meal_date', $today);
        })
        ->first();

    if ($guestMeal) {
        $guestMeal->delete();
        return back()->with('success', ucfirst($mealType).' removed successfully.');
    }

    return back()->with('info', 'No meal record found to undo.');
}
}
