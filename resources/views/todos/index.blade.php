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
        <a class="" href="{{route('todos.create')}}">Create todo</a>




        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripton
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Completed
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            @if(count($todos)>0)
            <tbody>
                @foreach ($todos as $todo)
                <tr>
                    <td>{{$todo ->title}}</td>
                    <td>{{$todo -> description}}</td>
                    <td>
                        @if($todo->is_completed == 1)
                        <a class="" href="#">completed</a>
                        @else
                        <a class="" href="#">incompleted</a>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success" href="{{ route('todos.show', $todo->id) }}">View</a>

                        <a class="btn-info" href="{{ route('todos.edit', $todo->id) }}">Edit</a>
                        <form method="post" action="{{ route('todos.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                            <input type="submit" class="btn-danger" value="Delete">
                        </form>

                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
        @else
        <h1 class="text-2xl	">No todos are created yet</h1>
        @endif

    </div>

</x-app-layout>