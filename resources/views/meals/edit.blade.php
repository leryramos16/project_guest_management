<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    <form method="POST" action="{{ route('meals.update', $meal->id) }}" class="max-w-md mx-auto bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    

    <h2 class="text-xl font-bold mb-4 capitalize">{{ $meal->meal_type }} Edit</h2>
    <label class="font-semibold" for="">Main:</label>
    <input name="main_menu" value="{{ $meal->main_menu }}" class="w-full mb-2 border p-2 rounded" placeholder="Main" required>
    <label class="font-semibold" for="">Soup:</label>
    <input name="soup" value="{{ $meal->soup }}" class="w-full mb-2 border p-2 rounded" placeholder="Soup" required>
    <label class="font-semibold" for="">Sub Menu:</label>
    <input name="sub_menu" value="{{ $meal->sub_menu }}" class="w-full mb-2 border p-2 rounded" placeholder="Sub Menu" required>
    <label class="font-semibold" for="">Fruits:</label>
    <input name="fruits" value="{{ $meal->fruits }}" class="w-full mb-4 border p-2 rounded" placeholder="Fruits" required>

    <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Update
    </button>
</form>

</body>
</html>