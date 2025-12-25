<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $guest->full_name }} - Meal Records</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <a href="{{ route('guest_meals.index') }}" class="text-blue-600 hover:underline">
         ← Back
    </a>

    <h1 class="text-2xl font-bold mt-4">
        {{ $guest->full_name }}
    </h1>

    <p class="text-gray-600 mb-4">
        Room: {{ $guest->rooms->pluck('room_number')->join(',') }}
    </p>

    <table class="w-full border border-collapse">
        <thead>
            <tr class="bg-gray-200">
                 <th class="p-2 border">Date</th>
                <th class="p-2 border">Meal Type</th>
                <th class="p-2 border">Main</th>
                <th class="p-2 border">Soup</th>
                <th class="p-2 border">Sub Menu</th>
                <th class="p-2 border">Fruits</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($guestMeals as $gm)
            <tr>
                <td class="p-2 border">
                    {{ Carbon\Carbon::parse($gm->meal->meal_date)->format('M d, Y') }}
                </td>
                <td class="p-2 border capitalize">
                    {{ $gm->meal->meal_type }}</td>
                </td>
                <td class="p-2 border">{{ $gm->meal->main_menu }}</td>
                <td class="p-2 border">{{ $gm->meal->soup }}</td>
                <td class="p-2 border">{{ $gm->meal->sub_menu }}</td>
                <td class="p-2 border">{{ $gm->meal->fruits }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center p-4">
                    No meals recorded for this guest.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
    
</body>
</html>