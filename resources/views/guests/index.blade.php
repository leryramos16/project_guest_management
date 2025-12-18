<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullBoard Guest</title>.
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-200 p-6">
    <div class="max-w-3xl mx-auto">
        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif
    </div>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        


        <div class="mb-6">
            <div class="mb-3">  
                <a href="{{ route('meals.create') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Create Menu
                </a>
                <a href="{{ route('guest_meals.index') }}">Guests Meal Records</a>
            </div>
             
            <h2 class="text-xl font-bold mb-2">Today's Menu</h2>
            
            
        @foreach (['breakfast', 'lunch', 'dinner'] as $mealType)
            @if(isset($todayMeals[$mealType]))
                <div class="mb-4 p-4 bg-gray-100 rounded shadow">
                    <h1 class="text-xl text-center font-semibold capitalize">{{ $mealType }}</h1>
                    <p><strong>Main: </strong>{{ $todayMeals[$mealType]->main_menu }}</p>
                    <p><strong>Soup: </strong>{{ $todayMeals[$mealType]->soup }}</p>
                    <p><strong>Sub Menu: </strong>{{ $todayMeals[$mealType]->sub_menu }}</p>
                    <p><strong>Fruits: </strong>{{ $todayMeals[$mealType]->fruits }}</p>
                </div>
            @else
                <div class="mb-4 p-4 bg-red-100 rounded shadow">
                    <p class="text-red-600 capitalize">{{ $mealType }} menu not set for today.</p>
                </div>
            @endif
        @endforeach
        </div>
        
        <a href="{{ route('guests.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Add Guest
        </a>
        <h1 class="text-2xl font-bold mt-2 text-gray-700">Guest List</h1>
    <form method="POST" action="{{ route('guest_meals.store') }}">
    @csrf

    <!-- Meal type dropdown -->
    <div class="mb-4">
        <label for="meal_type" class="font-semibold mr-2">Record Meal:</label>
        <select name="meal_type" id="meal_type" class="border p-1 rounded">
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dinner">Dinner</option>
        </select>
    </div>

    <!-- Hidden date -->
    <input type="hidden" name="meal_date" value="{{ now()->toDateString() }}">

   

    <!-- Guest table -->
    <table class="w-full mt-3 border border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border"> 
                            <!-- Select All checkbox -->
                <div class="">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" id="select-all">
                        
                    </label>
                </div>
                </th>
                <th class="p-2 border">Room No. & Full Name</th>
                <th class="p-2 border">Check-in</th>
                <th class="p-2 border">Check-out</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guests as $guest)
            <tr>
                <td class="p-2 border">
                    <input type="checkbox" name="guest_ids[]" value="{{ $guest->id }}" class="guest-checkbox">
                </td>
                <td class="p-2 border">{{ $guest->room_number }} - {{ $guest->full_name }}</td>
                <td class="p-2 border">{{ \Carbon\Carbon::parse($guest->check_in_date)->format('M d, Y') }}</td>
                <td class="p-2 border">{{ \Carbon\Carbon::parse($guest->check_out_date)->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center p-4">No guests found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Record button -->
    <div class="mt-4">
        <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Record Selected Guests
        </button>
    </div>
</form>

    </div>


  <script>
document.getElementById('select-all').addEventListener('change', function () {
    document.querySelectorAll('.guest-checkbox').forEach(cb => {
        cb.checked = this.checked;
    });
});
</script>
  
</body>
</html>