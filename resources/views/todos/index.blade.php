<x-app-layout>
    <div class="container mx-auto">


        <div class="py-2 bg-blue-200 flex justify-center mt-5 ">
            <p class="text-black-600 font-extrabold items-center text-2xl	">This Is Your Todos List</p>
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
            <div class="flex flex-row justify-between ml-20">
                <div class="flex justify-center items-center py-5">
                    <a href="{{ route('todos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create Todo
                    </a>
                </div>
                <div class="flex justify-center items-center py-5 ">
                    <a href="{{ route('categories.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Create Category
                    </a>
                </div>
                <div class="flex justify-center items-center py-5">
                    <form action="{{route('todos.index')}}" method="GET" class="flex items-center">
                        <input type="text" name="search" class="border p-2 rounded-md" placeholder="Search">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                            Search
                        </button>
                    </form>
                </div>
            </div>

            <form action="{{ route('todos.index') }}" method="GET" class="py-5">
                <label class="ml-5 text-lg font-bold ">Filter by Categories :</label>
                @foreach($categories as $category)
                <label>
                    <input type="checkbox" class="text-red-500" name="filter_categories[]" value="{{ $category->name }}" {{ in_array($category->name, (array)request('filter_categories')) ? 'checked' : '' }}>
                    {{ $category->name }}
                </label>
                @endforeach
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py- px-4 rounded ml-2">Apply Your Filter</button>
            </form>

            <table class="w-full text-sm text-left rtl:text-right text-black dark:text-gray-400 border border-gray-500">
                <thead class="text-xs text-black uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                    <tr>
                        <th scope="col" class="px-6 py-3 border border-gray-500 text-center font-extrabold text-base ">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 border border-gray-500 text-center font-extrabold	text-base ">
                            Descripton
                        </th>
                        <th scope="col" class="px-6 py-3 border border-gray-500 text-center font-extrabold	text-base ">
                            Completed
                        </th>
                        <th scope="col" class="px-6 py-3 border border-gray-500 text-center font-extrabold	text-base ">
                            Action
                        </th>
                        <th scope="col" class="px-6 py-3 border border-gray-500 text-center font-extrabold	text-base ">
                            Category
                        </th>
                    </tr>
                </thead>
                @if(count($todos) > 0)
                <!-- Display todos -->
                @else
                <h1 class="text-2xl">Click Create Todo to start Your Todo</h1>
                @endif
                @if(count($todos)>0)
                <tbody class="border border-gray-500 ">
                    @foreach ($todos as $todo)
                    <tr class="border border-gray-500 items-center text-center">
                        <td class="border border-gray-500">{{$todo ->title}}</td>
                        <td class="border border-gray-500"> {{$todo -> description}}</td>
                        <td class="border border-gray-500">
                            @if($todo->is_completed == 1)
                            <a class="text-green-500	" href="#">Completed </a>
                            @else
                            <a class="text-red-500" href="#">In Completed</a>
                            @endif
                        </td>
                        <td class="border border-gray-400  flex justify-around whitespace-nowrap ">
                            <a class="btn btn-success text-xl hover:text-blue-700 duration-200 text-blue-400" href="{{ route('todos.show', $todo->id) }}"><i class="fa-solid fa-eye"></i></a>

                            <a class="btn-info duration-200 text-xl text-slate-800 hover:text-slate-500 " href="{{ route('todos.edit', $todo->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form method="post" action="{{ route('todos.destroy', ['todo' => $todo->id]) }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                <button type="submit" class="btn-danger first-letter: text-xl text-rose-500 duration-200  hover:text-red-700">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>

                        <td> {{ $todo->category ? $todo->category->name : 'Uncategorized' }}</td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
            @else
            @endif


        </div>
    </div>


</x-app-layout>