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
        <a href="{{ route('guests.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
        </a>
        <h1 class="text-2xl font-bold mb-4">Create Meal Menu</h1>
        @if (session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif
        <form method="GET" action="{{ route('meals.create') }}" class="mb-4">
            <label class="block mb-2 font-semibold">Date</label>
            <input
                type="date"
                name="meal_date"
                value="{{ $mealDate }}"
                min="{{ now()->toDateString() }}"
                class="w-full border p-2 rounded"
                onchange="this.form.submit()"
            >
        </form>
        <form action="{{ route('meals.store') }}" method="POST">
            @csrf
            <input type="hidden" name="meal_date" value="{{ $mealDate }}">
            <label class="block mb-2">Meal Type</label>
            @if($allMealsSet)
             <select class=" italic w-full border p-2 mb-4 text-red-600" disabled>
                <option>*All meal types for this date are already set!*</option>
            </select>
            @else
            <select name="meal_type" class="w-full border p-2 mb-4" required> 
                @php
                    $mealTypes = ['breakfast', 'lunch', 'dinner'];
                @endphp

                @foreach ($mealTypes as $type)
                <option value="{{ $type }}"  @if(in_array($type, $usedMealTypes)) disabled @endif
                >
                    {{ ucfirst($type) }}
                    @if(in_array($type, $usedMealTypes)) (Already set) @endif    
                </option>
                @endforeach
            </select>
            @endif
            <label class="block mb-2">Main Menu</label>
            <input type="text" name="main_menu" class="w-full border p-2 mb-4" autocomplete="off" required>

            <label class="block mb-2">Soup</label>
            <input type="text" name="soup" class="w-full border p-2 mb-4" autocomplete="off" required>

            <label class="block mb-2">Sub Menu</label>
            <input type="text" name="sub_menu" class="w-full border p-2 mb-4" autocomplete="off" required>

            <label class="block mb-2">Fruits</label>
            <input type="text" name="fruits" class="w-full border p-2 mb-4" autocomplete="off" required>

            <button
                @class([
                    'px-4 py-2 rounded text-white',
                    'bg-blue-600 hover:bg-blue-700' => !$allMealsSet,
                    'bg-gray-400 cursor-not-allowed' => $allMealsSet,
                ])
                @if($allMealsSet) disabled @endif
            >
                Save Meal
            </button>

        </form>
    </div>
</body>
</html>