<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Guest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">Add Guest</h1>

        <form action="{{ route('guests.store') }}" method="POST">
            @csrf

            <!-- Name -->
            <label class="block mb-2 text-sm font-medium">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full p-2 border rounded mb-4" autocomplete="off" required>

            <!-- Room Number -->
             @if ($errors->has('room_ids'))
                <div class="mb-3 p-2 bg-red-100 text-center text-red-700 rounded text-sm">
                        {{ $errors->first('room_ids') }}
                </div>
            @endif
             <label class="block mb-2 text-sm font-medium">Room Numbers</label>
             <div class="grid grid-cols-2 gap-2">
                @foreach ($rooms as $room)
                <label class="flex items-center gap-2 p-2 border rounded
                    {{ in_array($room->id, $occupiedRoomIds) ? 'opacity-50' : '' }}">

                    <input type="checkbox"
                            name="room_ids[]"
                            value="{{ $room->id }}"
                            {{ in_array($room->id, $occupiedRoomIds) ? 'disabled' : '' }}
                            class="w-4 h-4"
                    >
                    <span>
                        Room {{ $room->room_number }}
                        {{ in_array($room->id, $occupiedRoomIds) ? '(Occupied)' : '' }}
                    </span>
                </label>
                @endforeach
             </div>
            <!-- Check-in Date -->
            <label class="block mb-2 text-sm font-medium">Check-in Date</label>
            <input type="date" name="check_in_date" value="{{ old('check_in_date') }}" class="w-full p-2 border rounded mb-4" required>

            <!-- Check-out Date -->
            <label class="block mb-2 text-sm font-medium">Check-out Date</label>
            <input type="date" name="check_out_date" value="{{ old('check_out_date') }}" class="w-full p-2 border rounded mb-4" required>

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Save Guest
            </button>
        </form>

        <a href="{{ route('guests.index') }}" class="text-blue-500 block mt-4">← Back to Guest List</a>
    </div>


</body>
</html>
