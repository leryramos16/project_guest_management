<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Meals Records</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 md:p-6">

<div class="max-w-4xl mx-auto bg-white p-4 md:p-6 rounded shadow">

    <!-- Back -->
    <a href="{{ route('guests.index') }}" class="inline-block mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
        </svg>
    </a>

    <h1 class="text-2xl font-bold mb-4">Guest Meals Records</h1>

    <!-- Search / Filter -->
    <form action="{{ route('guest_meals.index') }}" method="GET"
          class="mb-4 flex flex-wrap gap-2 text-sm">
        <input type="text" name="search" placeholder="Search guest..."
               value="{{ request('search') }}"
               class="p-2 border rounded flex-1" autocomplete="off">
        <input type="date" name="meal_date"
               value="{{ request('meal_date') }}"
               class="p-2 border rounded">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Search</button>
        <a href="{{ route('guest_meals.index') }}"
           class="px-4 py-2 bg-gray-400 text-white rounded">Reset</a>
    </form>

@php
    $groupedByDate = collect($guestMeals->items())->groupBy(fn($gm) => $gm->meal->meal_date);
@endphp

<!-- ================= DESKTOP TABLE ================= -->
<div class="hidden md:block overflow-x-auto">
<table class="w-full border border-collapse text-sm">
<thead>
<tr class="bg-gray-200">
    <th class="p-2 border">Guest & Rooms</th>
    <th class="p-2 border">Meal</th>
    <th class="p-2 border">Main</th>
    <th class="p-2 border">Soup</th>
    <th class="p-2 border">Sub</th>
    <th class="p-2 border">Fruits</th>
    <th class="p-2 border">Date</th>
</tr>
</thead>
<tbody>

@forelse ($groupedByDate as $date => $mealsByDate)
<tr class="bg-gray-300">
    <td colspan="7" class="p-3 font-bold">
        {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
    </td>
</tr>

@foreach ($mealsByDate->groupBy(fn($gm) => $gm->meal->meal_type) as $mealType => $rows)
<tr class="bg-gray-100">
    <td colspan="7" class="p-2 font-semibold text-blue-600 capitalize">
        {{ $mealType }}
    </td>
</tr>

@foreach ($rows as $gm)
<tr>
    <td class="p-2 border">
        <strong>{{ $gm->guest->rooms->pluck('room_number')->join(', ') }}</strong> —
        <a href="{{ route('guests.meals.show', $gm->guest->id) }}"
           class="text-blue-600 font-semibold hover:underline">
            {{ $gm->guest->full_name }}
        </a>
    </td>
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
    <td colspan="7" class="p-4 text-center">No records found.</td>
</tr>
@endforelse

</tbody>
</table>
</div>

<!-- ================= MOBILE CARDS ================= -->
<div class="md:hidden space-y-4">
@forelse ($groupedByDate as $date => $mealsByDate)

<div class="sticky top-0 bg-gray-200 p-2 rounded font-bold">
    {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}
</div>

@foreach ($mealsByDate->groupBy(fn($gm) => $gm->meal->meal_type) as $mealType => $rows)
<div class="text-blue-600 font-semibold capitalize px-1">
    {{ $mealType }}
</div>

@foreach ($rows as $gm)
<div class="bg-white rounded-lg shadow p-4">

    <div class="font-semibold text-lg">
        {{ $gm->guest->full_name }}
    </div>
    <div class="text-sm text-gray-600">
        Room {{ $gm->guest->rooms->pluck('room_number')->join(', ') }}
    </div>

    <div class="grid grid-cols-2 gap-2 text-sm mt-3">
        <div><b>Main:</b> {{ $gm->meal->main_menu }}</div>
        <div><b>Soup:</b> {{ $gm->meal->soup }}</div>
        <div><b>Sub:</b> {{ $gm->meal->sub_menu }}</div>
        <div><b>Fruits:</b> {{ $gm->meal->fruits }}</div>
    </div>

    <div class="flex justify-between text-xs text-gray-500 mt-3">
        <span>{{ ucfirst($gm->meal->meal_type) }}</span>
        <span>{{ \Carbon\Carbon::parse($gm->meal->meal_date)->format('M d, Y') }}</span>
    </div>

    <a href="{{ route('guests.meals.show', $gm->guest->id) }}"
       class="block mt-3 text-center text-blue-600 font-semibold hover:underline">
        View Guest Record
    </a>
</div>
@endforeach
@endforeach

@empty
<div class="p-4 text-center bg-white rounded shadow">
    No records found.
</div>
@endforelse
</div>
<div class="mt-6">
    {{ $guestMeals->links() }}
</div>
</div>
</body>
</html>
