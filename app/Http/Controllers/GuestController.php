<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{

    $today = Carbon::today();

    // hindi mafefetch at all ang checkout na
    $guests = Guest::active()
        ->with('rooms')
        ->orderBy('full_name')
        ->get();

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
        $rooms = Room::orderBy('room_number')->get();

        // Rooms occupied by ACTIVE guests
        $occupiedRoomIds = Guest::active()
            ->with('rooms')
            ->get()
            ->pluck('rooms')
            ->flatten()
            ->pluck('id')
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
        'room_ids' => 'required|array|min:1',
        'room_ids.*' => 'exists:rooms,id',
        'check_in_date' => 'required|date',
        'check_out_date' => 'required|date|after_or_equal:check_in_date',
    ]);

    // Create the group leader
    $guest = Guest::create([
        'full_name' => $validated['full_name'],
        'check_in_date' => $validated['check_in_date'],
        'check_out_date' => $validated['check_out_date'],
        'is_group_leader' => true,
    ]);

    // Attach selected rooms
    $guest->rooms()->attach($validated['room_ids']);

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
