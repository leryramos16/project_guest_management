<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Meal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Create Meal Menu</h1>
        @if (session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        <form action="{{ route('meals.store') }}" method="POST">
            @csrf
            <label class="block mb-2">Date</label>
            <input type="date" name="meal_date" class="w-full border p-2 mb-4" required>
            <label class="block mb-2">Meal Type</label>
            <select name="meal_type" class="w-full border p-2 mb-4" required> 
                <option value="breakfast">Breakfast</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
            </select>
            <label class="block mb-2">Main Menu</label>
            <input type="text" name="main_menu" class="w-full border p-2 mb-4" required>

            <label class="block mb-2">Soup</label>
            <input type="text" name="soup" class="w-full border p-2 mb-4">

            <label class="block mb-2">Sub Menu</label>
            <input type="text" name="sub_menu" class="w-full border p-2 mb-4">

            <label class="block mb-2">Fruits</label>
            <input type="text" name="fruits" class="w-full border p-2 mb-4">

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Meal
            </button>
        </form>
    </div>
</body>
</html>