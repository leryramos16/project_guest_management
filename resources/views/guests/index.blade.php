<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FullBoard Guest</title>.
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">Guest List</h1>
        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif
        <a href="{{ route('guests.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Add Guest
        </a>

        <table class="w-full mt-10 border">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-2 border">Full Name</th>
                    <th class="p-2 border">Check-in</th>
                    <th class="p-2 border">Check-out</th>
                </tr>
            </thead>
            <tbody class="">
                @forelse ($guests as $guest)
                <tr class="">
                    <td class="p-2 border">{{ $guest->full_name }}</td>
                    <td class="p-2 border">{{\Carbon\Carbon::parse($guest->check_in_date)->format('M d, Y') }}</td>
                    <td class="p-2 border">{{ \Carbon\Carbon::parse($guest->check_out_date)->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4">
                            No guests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>