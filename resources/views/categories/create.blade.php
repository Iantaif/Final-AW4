<!-- Trong create.blade.php -->
<x-app-layout>
    <div class="container mx-auto flex flex-col justify-center">

        <div class="py-2 bg-blue-200 flex justify-center">
            <p class="text-black-600 font-extrabold items-center">Create Category Page</p>
        </div>

        <div class="flex flex-row max-w-sm mx-auto mt-5">
            <form method="post" action="{{ route('categories.store') }}" class="space-y-4">
                @csrf
                <label for="name" class="block text-xl font-bold text-gray-700 ">Category Name :</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md" />
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Category
                </button>
            </form>
        </div>
        <div class="flex flex-col justify-center items-center pt-10">
            @if ($categories->count() > 0)
            <p class="mb-4 text-lg font-semibold">Existing Categories:</p>
            <ul class="list-disc">
                @foreach ($categories as $existingCategory)
                <li class="flex items-center justify-between mb-2">
                    <span>{{ $existingCategory->name }} : </span>
                    <form action="{{ route('categories.destroy', $existingCategory->id) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </form>
                </li>
                @endforeach
            </ul>
            @else
            <p>No existing categories found.</p>
            @endif
        </div>
    </div>
</x-app-layout>