<x-app-layout>

    <div class="py-2 bg-blue-200 flex justify-center ">
        <p class="text-black-600 font-extrabold items-center">Index Todo</p>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if(Session::has('alert-success'))
        <div class="alert-success p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            {{ Session::get('alert-success') }}
        </div>
        @endif
        @if(Session::has('alert-info'))
        <div class="alert-info p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-sky-800 dark:text-blue-400" role="alert">
            {{ Session::get('alert-info') }}
        </div>
        @endif

        @if(Session::has('alert-error'))
        <div class="alert-success p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-red-800 dark:text-blue-400" role="alert">
            {{ Session::get('error') }}
        </div>
        @endif
        <div class="flex justify-center items-center py-5">
            <a href="{{ route('todos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Todo
            </a>
        </div>
        <div class="flex justify-center items-center py-5">
            <form action="search_data" method="GET" class="flex items-center">
                <input type="text" name="search" class="border p-2 rounded-md" placeholder="Search">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    Search
                </button>
            </form>
        </div>



        <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-400 border border-gray-500">
            <thead class="text-xs text-black uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3 border border-gray-500">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3 border border-gray-500">
                        Descripton
                    </th>
                    <th scope="col" class="px-6 py-3 border border-gray-500 ">
                        Completed
                    </th>
                    <th scope="col" class="px-6 py-3 border border-gray-500">
                        Action
                    </th>
                </tr>
            </thead>
            @if(count($todos) > 0)
            <!-- Display todos -->
            @else
            <h1 class="text-2xl">No todos match the search criteria</h1>
            @endif
            @if(count($todos)>0)
            <tbody class="border border-gray-500 ">
                @foreach ($todos as $todo)
                <tr class="border border-gray-500 items-center">
                    <td class="border border-gray-500">{{$todo ->title}}</td>
                    <td class="border border-gray-500"> {{$todo -> description}}</td>
                    <td class="border border-gray-500">
                        @if($todo->is_completed == 1)
                        <a class="text-green-500	" href="#">completed</a>
                        @else
                        <a class="text-rose-700" href="#">incompleted</a>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success text-blue-400" href="{{ route('todos.show', $todo->id) }}">View</a>

                        <a class="btn-info text-slate-800" href="{{ route('todos.edit', $todo->id) }}">Edit</a>
                        <form method="post" action="{{ route('todos.destroy', ['id' => $todo->id]) }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                            <input type="submit" class="btn-danger text-rose-500" value="Delete">
                        </form>

                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
        @else
        <h1 class="text-2xl	">No todos are created yet</h1>
        <h1 class="text-2xl	">Click Search to reload the data</h1>


        @endif


    </div>

</x-app-layout>