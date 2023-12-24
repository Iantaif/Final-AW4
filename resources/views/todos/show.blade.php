<x-app-layout>
    <div class="flex flex-col items-center justify-center space-y-6">

        <div class="text-center">
            <h2 class="mb-1 text-2xl font-bold">Todo Title</h2>
            <p class="text-lg text-rose-400 hover:text-gray-800 duration-200">{{ $todo->title }}</p>

            <h2 class="mt-4 mb-1 text-2xl font-bold">Todo Description</h2>
            <p class="text-lg text-rose-400 hover:text-gray-800 duration-200">{{ $todo->description }}</p>
        </div>

        <a href="{{ url()->previous() }}" class="text-xl text-blue-500 hover:underline self-center">Go back</a>

    </div>

</x-app-layout>