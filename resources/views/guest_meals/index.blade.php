<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Meals Records</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <a href="{{ route('guests.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
        </a>
        <h1 class="text-2xl font-bold mb-4">Guest Meals Records</h1>
        <div class="overflow-x-auto">
            <div>
                <form action="{{ route('guest_meals.index') }}" method="GET" class="mb-4 flex flex-wrap items-center gap-1 text-sm">
                <input type="text" name="search" placeholder="Search guest..."
                        value="{{ request('search') }}"
                        class="p-2 border rounded flex-1"
                        autocomplete="off">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" > 
                    Search
                </button>
                <input type="date"
                        name="meal_date"
                        value="{{ request('meal_date') }}"
                        class="p-2 border rounded">
                <button type="submit"  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Filter Date
                </button>
                <a href="{{ route('guest_meals.index') }}"
                class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                    Reset
                </a>
                            
            </form>
            </div>
            
            <table class="w-full border border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 border">Guest</th>
            <th class="p-2 border">Meal Type</th>
            <th class="p-2 border">Main</th>
            <th class="p-2 border">Soup</th>
            <th class="p-2 border">Sub Menu</th>
            <th class="p-2 border">Fruits</th>
            <th class="p-2 border">Meal Date</th>
        </tr>
    </thead>
    <tbody>
@php
    $groupedByDate = $guestMeals->groupBy(fn($gm) => $gm->meal->meal_date);
@endphp

@forelse ($groupedByDate as $date => $mealsByDate)

    {{-- Date Header --}}
    <tr class="bg-gray-300">
        <td colspan="7" class="p-3 font-bold text-lg">
            {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
        </td>
    </tr>

    @foreach ($mealsByDate->groupBy(fn($gm) => $gm->meal->meal_type) as $mealType => $guestMealsByType)

        {{-- Meal Type Header --}}
        <tr class="bg-gray-100">
            <td colspan="7" class="p-2 font-semibold capitalize text-blue-600">
                {{ $mealType }}
            </td>
        </tr>

        @foreach ($guestMealsByType as $gm)
            <tr>
                <td class="p-2 border"><strong>{{ $gm->guest->room?->room_number ?? 'No Room' }}</strong> - {{ $gm->guest->full_name }}</td>
                <td class="p-2 border capitalize">{{ $gm->meal->meal_type }}</td>
                <td class="p-2 border">{{ $gm->meal->main_menu }}</td>
                <td class="p-2 border">{{ $gm->meal->soup }}</td>
                <td class="p-2 border">{{ $gm->meal->sub_menu }}</td>
                <td class="p-2 border">{{ $gm->meal->fruits }}</td>
                <td class="p-2 border">
                    {{ \Carbon\Carbon::parse($gm->meal->meal_date)->format('M d, Y') }}
                </td>
            </tr>
        @endforeach

    @endforeach

@empty
    <tr>
        <td colspan="7" class="text-center p-4">
            No guest meals recorded yet.
        </td>
    </tr>
@endforelse
</tbody>

</table>
        </div>
        


    </div>
</body>
</html>
