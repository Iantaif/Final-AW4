<?php

namespace App\Http\Controllers\API;

use App\Models\Todo;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->todos()
        ->when($request->input('search'), function ($query, $search) {
            $query
                ->where('title', 'like', '%' . $search . '%')
                ->orwhere('description', 'like', '%' . $search . '%');
        });

    $todos = $query->simplePaginate();

    return view('todos.index', compact('todos'));

    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(TodoRequest $request)
    {

        Todo::factory()->create($request->validated());

        $request->session()->flash('alert-success', 'Todo created Suscessfully');

        return to_route('todos.index');
    }

    public function show(Todo $todo)
    {
        $this->authorize('update', $todo);

        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);

        return view('todos.edit', compact('todo'));
    }

    public function update(TodoRequest $request, Todo $todo)
    {

        $this->authorize('update', $todo);

        $validatedData = $request->validated();

        $todo->update($validatedData);

        $request->session()->flash('alert-info', 'Todos update success');

        return redirect()->route('todos.index');
    }

    public function destroy(Request $request, Todo $todo)
    {

        $this->authorize('update', $todo);

        $todo->delete();

        $request->session()->flash('alert-success', 'Todos delete success');

        return to_route('todos.index');
    }
   
}
