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

        <h1 class="text-2xl font-bold mb-4">Guest Meals Records</h1>

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
        @forelse ($guestMeals as $gm)
            <tr>
                <td class="p-2 border">{{ $gm->guest->full_name }}</td>
                <td class="p-2 border capitalize">{{ $gm->meal->meal_type }}</td>
                <td class="p-2 border">{{ $gm->meal->main_menu }}</td>
                <td class="p-2 border">{{ $gm->meal->soup }}</td>
                <td class="p-2 border">{{ $gm->meal->sub_menu }}</td>
                <td class="p-2 border">{{ $gm->meal->fruits }}</td>
                <td class="p-2 border">{{ \Carbon\Carbon::parse($gm->meal->meal_date)->format('M d, Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center p-4">No guest meals recorded yet.</td>
            </tr>
        @endforelse
    </tbody>
</table>


    </div>
</body>
</html>
