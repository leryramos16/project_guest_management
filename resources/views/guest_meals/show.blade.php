<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $guest->full_name }} - Meal Records</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 p-4 md:p-6">

<div class="max-w-4xl mx-auto bg-white p-4 md:p-6 rounded shadow">

    <a href="{{ route('guest_meals.index') }}"
       class="text-blue-600 hover:underline text-sm">
        ← Back
    </a>

    <h1 class="text-2xl font-bold mt-3">
        {{ $guest->full_name }}
    </h1>

    <p class="text-gray-600 mb-4">
        Room: {{ $guest->rooms->pluck('room_number')->join(', ') }}
    </p>

    <!-- ================= DESKTOP TABLE ================= -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full border border-collapse text-sm">
            <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Meal</th>
                <th class="p-2 border">Main</th>
                <th class="p-2 border">Soup</th>
                <th class="p-2 border">Sub</th>
                <th class="p-2 border">Fruits</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($guestMeals as $gm)
                <tr>
                    <td class="p-2 border">
                        {{ \Carbon\Carbon::parse($gm->meal->meal_date)->format('M d, Y') }}
                    </td>
                    <td class="p-2 border capitalize">{{ $gm->meal->meal_type }}</td>
                    <td class="p-2 border">{{ $gm->meal->main_menu }}</td>
                    <td class="p-2 border">{{ $gm->meal->soup }}</td>
                    <td class="p-2 border">{{ $gm->meal->sub_menu }}</td>
                    <td class="p-2 border">{{ $gm->meal->fruits }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center">
                        No meals recorded for this guest.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- ================= MOBILE CARDS ================= -->
    <div class="md:hidden space-y-4">
        @forelse ($guestMeals as $gm)
            <div class="bg-white rounded-lg shadow p-4">

                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span class="capitalize font-semibold">
                        {{ $gm->meal->meal_type }}
                    </span>
                    <span>
                        {{ \Carbon\Carbon::parse($gm->meal->meal_date)->format('M d, Y') }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-2 text-sm mt-3">
                    <div><b>Main:</b> {{ $gm->meal->main_menu }}</div>
                    <div><b>Soup:</b> {{ $gm->meal->soup }}</div>
                    <div><b>Sub:</b> {{ $gm->meal->sub_menu }}</div>
                    <div><b>Fruits:</b> {{ $gm->meal->fruits }}</div>
                </div>

            </div>
        @empty
            <div class="bg-white rounded shadow p-4 text-center">
                No meals recorded for this guest.
            </div>
        @endforelse
    </div>
    <!-- Pagination -->
<div class="mt-4">
    {{ $guestMeals->links() }}
</div>

</div>

</body>
</html>
