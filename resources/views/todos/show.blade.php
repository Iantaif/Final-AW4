<x-app-layout>
    <div class="flex flex-col ">

        <div class="flex items-center justify-center ">
            <div class="text-center">
                <b class="block mb-1 text-2xl">Your todo</b>
                <p class="text-gray-800 text-lg dark:text-white">{{ $todo->title }}</p>

                <b class="block mt-4 mb-1 text-2xl">Your description</b>
                <p class="text-gray-800 text-lg dark:text-white">{{ $todo->description }}</p>
            </div>
        </div>
        <a href="{{ url()->previous() }}" class="text-blue-500 text-xl hover:underline self-center	">Go back</a>
</x-app-layout>