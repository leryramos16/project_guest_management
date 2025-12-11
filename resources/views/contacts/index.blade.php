<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<!-- Header -->
<div class="text-center mb-4">
    <h1 class="text-3xl font-bold text-gray-600">My Contacts</h1>
</div>

<!-- Success Message -->
@if(session('success'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    x-transition
    class="max-w-2xl mx-auto mb-4 p-4 bg-green-100 border border-green-400 text-center text-green-700 rounded-lg shadow-sm"
>
    {{ session('success') }}
</div>
@endif


<!-- Add Contact button below -->
<div class="flex justify-center mb-6">
    <a href="{{ route('contacts.create') }}"
       class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-xl shadow hover:bg-indigo-700 transition">
        <span class="text-lg">+</span> Add New Contact
    </a>
</div>

    
    
    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Social Media</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($contacts as $contact)
            <tr>
                <td class="flex items-center justify-center">
                    @if($contact->image)
                        <img src="{{ asset('storage/' . $contact->image) }}" class="w-12 h-12 rounded-full object-cover mt-1" alt="">
                    @else
                        <span class="text-gray-400">No Image</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $contact->first_name }} {{ $contact->middle_name }} {{ $contact->last_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $contact->phone }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $contact->email ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($contact->facebook)
                        <a href="{{ $contact->facebook }}" target="_blank" class="text-blue-600 hover:underline">Facebook</a>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('contacts.edit', $contact) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
                   <!-- Delete Button -->
<div x-data="{ open: false }" class="inline">
    <!-- Trigger Button -->
    <button @click="open = true" type="button" class="text-red-600 hover:text-red-900">
        Delete
    </button>

    <!-- Modal -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 flex items-center justify-center bg-opacity-50 z-50"
    >
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Are you sure you want to delete <span class="font-bold">{{ $contact->first_name }}</span>?</p>

            <div class="flex justify-end gap-4">
                <!-- Cancel Button -->
                <button @click="open = false"
                        type="button"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>

                <!-- Confirm Delete -->
                <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-gray-500">No contacts found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


</body>
</html>