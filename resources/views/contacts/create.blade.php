<!DOCTYPE html>
<html>
<head>
    <title>Add Contact</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

        <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-md mt-10">
    <h2 class="text-2xl font-semibold mb-6">Add New Contact</h2>

    <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Profile Image -->
         <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Profile Image</label>
            <div class="mt-2 flex items-center gap-4">
                <img id="preview" class="w-16 h-16 rounded-full object-cover hidden">
            
            <input type="file" id="image" name="image"
                onchange="previewImage(event)"
                class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>
         </div>

        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" name="first_name" id="first_name"
                value="{{ old('first_name') }}"
                class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3"
                required>
            @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Middle Name -->
        <div>
            <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
            <input type="text" name="middle_name" id="middle_name"
                value="{{ old('middle_name') }}"
                class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3">
            @error('middle_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" name="last_name" id="last_name"
                value="{{ old('last_name') }}"
               class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3"
                required>
            @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone"
                value="{{ old('phone') }}"
                class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3"
                required>
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email"
                value="{{ old('email') }}"
                class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Social Media -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Social Media (Optional)</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-1">
                <input type="url" name="facebook" placeholder="Facebook URL"
                    value="{{ old('facebook') }}"
                    class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3">
                <input type="url" name="instagram" placeholder="Instagram URL"
                    value="{{ old('instagram') }}"
                   class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3">
                <input type="url" name="tiktok" placeholder="TikTok URL"
                    value="{{ old('tiktok') }}"
                   class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3">
                <input type="url" name="twitter" placeholder="Twitter URL"
                    value="{{ old('twitter') }}"
                   class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3">
            </div>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save Contact
            </button>
        </div>
            <a href="{{ route('contacts.index') }}">Back to Phonebook</a>

    </form>
</div>

    
<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.classList.remove('hidden');
}
</script>
</body>
</html>
