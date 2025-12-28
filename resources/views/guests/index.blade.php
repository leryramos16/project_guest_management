<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullBoard Guest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-200 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <div id="menu-error"
        class="hidden mb-4 mx-auto max-w-md p-3 bg-red-200 text-red-700 rounded text-center transition-opacity duration-700 opacity-100">
        *Selected meal has no menu set for today.*
        </div>
        <div class="mb-6">
            <div class="mb-3">  
                <a href="{{ route('meals.create') }}" class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">
                +
                </a>
                <a href="{{ route('guest_meals.index') }}"
                    class="inline-flex items-center gap-2 text-gray-700 hover:text-blue-600 font-medium">
                        
                        <!-- List / Records Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>

                        <span>Guests Meal Records</span>
                </a>

            </div>
             
            <h2 class="text-xl font-bold mb-2">Today's Menu</h2>
            
            
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                @foreach (['breakfast', 'lunch', 'dinner'] as $mealType)
                @if(isset($todayMeals[$mealType]))
                    <div class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition relative">
                        <h2 class="text-lg font-bold text-center capitalize mb-2">{{ $mealType }}</h2>
                        <!-- Edit button -->
                         <a href="{{ route('meals.edit', $todayMeals[$mealType]->id) }}"
                            class="absolute top-2 right-2 p-2 bg-gray-100 rounded-full hover:bg-blue-100 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M11 4h2m2 2l5 5L7 20H2v-5L15 2l5 5" />
                                </svg>
                        </a>

                        <ul class="text-gray-700 space-y-1">
                            <li><span class="font-semibold">Main:</span> {{ $todayMeals[$mealType]->main_menu }}</li>
                            <li><span class="font-semibold">Soup:</span> {{ $todayMeals[$mealType]->soup }}</li>
                            <li><span class="font-semibold">Sub Menu:</span> {{ $todayMeals[$mealType]->sub_menu }}</li>
                            <li><span class="font-semibold">Fruits:</span> {{ $todayMeals[$mealType]->fruits }}</li>
                        </ul>
                    </div>
                @else
                    <div class="bg-red-100 text-red-700 rounded-lg shadow p-4 text-center flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86L12 5 5.07 19z" />
                        </svg>
                        <p class="capitalize font-semibold">{{ $mealType }} menu not set for today.</p>
                    </div>
                @endif
            @endforeach
            </div>

        
        <a href="{{ route('guests.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Add Guest
        </a>
        <h1 class="text-2xl font-bold mt-2 text-gray-700">Guest List</h1>
        @if ($errors->any())
            <div class="mb-4 mx-auto max-w-md p-3 bg-red-100 text-red-700 rounded text-center">
                {{ $errors->first() }}
            </div>
        @endif
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

    <div id="flash-message" class="transition-opacity duration-700 opacity-100">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="mx-auto max-w-md mb-4 p-4 rounded-lg 
            bg-red-100 border border-red-300 
            text-red-800 text-sm text-center
            flex items-center justify-center gap-2">
    
        <!-- Error icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 text-red-600"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v2m0 4h.01M5.07 19h13.86L12 5 5.07 19z" />
        </svg>

    <strong>{{ session('info') }}</strong>
</div>

        @endif
    </div>


    <!-- Hidden date -->
    <input type="hidden" name="meal_date" value="{{ now()->toDateString() }}">

    


    

    <!-- Guest error div -->
    <div id="guest-error" class="hidden mb-4 mx-auto max-w-md p-3 bg-red-100 text-red-700 rounded text-center transition-opacity duration-700 opacity-100">
            *Please select at least one guest before recording.*
    </div>
    <!-- Guest table -->
    <table class="w-full mt-3 border border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border"> 
                            <!-- Select All checkbox -->
                <div class="">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" id="select-all">All
                        
                    </label>
                </div>
                </th>
                <th class="p-2 border">Guest / Rooms</th>
                <th class="p-2 border">Check-in</th>
                <th class="p-2 border">Check-out</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($guests as $guest)
            <tr>
                <td class="p-2 border">
                    <input type="checkbox" name="guest_ids[]" value="{{ $guest->id }}" class="guest-checkbox" data-meals='@json($guestMealsToday[$guest->id] ?? [])'>
                </td>
                <td class="p-2 border">
                    <a href="{{ route('guest_meals.show', $guest->id) }}" 
                        class="font-medium text-blue-600 hover:underline">
                            {{ $guest->full_name }}
                    </a>

                    <div class="flex gap-2 mt-1 text-xs">
                        @foreach (['breakfast', 'lunch', 'dinner'] as $meal)
                            @php
                                $hasMeal = in_array(
                                    $meal,
                                    $guestMealsToday[$guest->id] ?? []
                                );
                            @endphp

                            <span class="
                                px-2 py-0.5 rounded
                                {{ $hasMeal
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-400'
                                }}">
                                {{ ucfirst($meal) }}
                                {{ $hasMeal ? '✓' : '—' }}
                            </span>
                        @endforeach
                    </div>

                    <small class="text-gray-600 block mt-1">
                        Rooms: {{ $guest->rooms->pluck('room_number')->join(', ') }}
                    </small>
                </td>

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


<!-- Scroll script sa flash message -->
 @if (session('success') || session('info'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const message = document.getElementById('flash-message');
        if (!message) return; 
            message.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        // Fade out after 3 seconds
        setTimeout(() => {
            message.classList.remove('opacity-100');
            message.classList.add('opacity-0');
        }, 3000);

        //Remove from layout after fade
        setTimeout(() => {
            message.remove();
        }, 3800);
    });
</script>
@endif


<script>
    // Blade JSON
    const availableMeals = @json($todayMeals->keys()->toArray());
</script>



<!-- DISABLE “SELECT ALL” LOGIC -->
<script>
document.getElementById('select-all').addEventListener('change', function () {
    document.querySelectorAll('.guest-checkbox').forEach(cb => {
        if (!cb.disabled) {
            cb.checked = this.checked;
        }
        
    });
});

document.querySelector('form').addEventListener('submit', function (e) {
    const checkedGuests = document.querySelectorAll('.guest-checkbox:checked');
    const selectedMeal = document.getElementById('meal_type').value;

    const guestError = document.getElementById('guest-error');
    const menuError  = document.getElementById('menu-error');

    // reset errors
    guestError.classList.add('hidden');
    menuError.classList.add('hidden');

    //  no guests selected
    if (checkedGuests.length === 0) {
        e.preventDefault();
        guestError.classList.remove('hidden');
        guestError.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
        setTimeout(() => {
            guestError.classList.add('opacity-0')
        }, 3000);

        setTimeout(() => {
            guestError.classList.add('hidden');
            guestError.classList.remove('opacity-0');
        }, 3800);

        return;
    }

    //  no menu for selected meal
    if (!availableMeals.includes(selectedMeal)) {
        e.preventDefault();
        menuError.classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Fade out after 3 seconds
    setTimeout(() => {
        menuError.classList.add('opacity-0');
    }, 3000);

    // Remove from layout after fade
    setTimeout(() => {
        menuError.classList.add('hidden');
        menuError.classList.remove('opacity-0');
    }, 3800);

        return;
    }
});
</script>


<!-- DISABLE CHECKBOX BASED ON MEAL TYPE -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mealSelect = document.getElementById('meal_type');
        const guestCheckboxes = document.querySelectorAll('.guest-checkbox');

        function updateGuestCheckboxes() {
            const selectedMeal = mealSelect.value;

            guestCheckboxes.forEach(cb => {
                const guestMeals = JSON.parse(cb.dataset.meals || '[]');

                if (guestMeals.includes(selectedMeal)) {
                    cb.checked = false;
                    cb.disabled = true;
                } else {
                    cb.disabled = false;
                }
            });
        }

        // Run on page load
        updateGuestCheckboxes();

        //Run when meal type changes
        mealSelect.addEventListener('change', updateGuestCheckboxes);
    })
</script>




  
</body>
</html>