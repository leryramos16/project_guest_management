<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use App\Models\Rooms;
use App\Models\Meal;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $guests = Guest::with('room')->get();

    // Get today's meals keyed by meal_type
    $todayMeals = Meal::where('meal_date', today())
                      ->get()
                      ->keyBy('meal_type');
    
    return view('guests.index', compact('guests', 'todayMeals'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Rooms::orderBy('room_number')->get();

        // Get rooms that are currently occupied today
        $occupiedRoomIds = Guest::whereDate('check_out_date', '>=', today())
                                ->pluck('room_id')
                                ->toArray();

        return view('guests.create', compact('rooms', 'occupiedRoomIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'room_id' => 'required|exists:rooms,id',
        'check_in_date' => 'required|date',
        'check_out_date' => 'required|date|after_or_equal:check_in_date',
    ]);

    

    

    Guest::create($validated);

    return redirect()->route('guests.index')->with('success', 'Guest added successfully!');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
