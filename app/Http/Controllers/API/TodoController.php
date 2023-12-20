<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;


class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Todo::query()
        ->when(request('search'), function (Builder $query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        });

    $todos = $query->simplePaginate();
    if ($request->wantsJson()) {
        return response()->json($todos, 200);
    }

    return view('todos.index', compact('todos'));
        
    }
    public function create()
    {
        return view('todos.create');
    }
    public function store(TodoRequest $request)
    {
        
        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => 0,

        ]);
        $request->session()->flash('alert-success', 'Todo created Suscessfully');
        return to_route('todos.index');
    }
    public function show($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to loacate todos');

            return to_route('todos.index')->withErrors([
                'error' => 'Unable to look at todos'
            ]);
        }
        return view('todos.show', ['todo' => $todo]);
    }
    public function edit($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to loacate todos');

            return to_route('todos.index')->withErrors([
                'error' => 'Unable to look at todos'
            ]);
        }
        return view('todos.edit', ['todo' => $todo]);
    }
    public function update(TodoRequest $request)
    {
        $todo = Todo::find($request->todo_id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to loacate todos');

            return to_route('todos.index')->withErrors([
                'error' => 'Unable to updatetodos'
            ]);
        }
        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed,


        ]);
        $request->session()->flash('alert-info', 'Todos update success');
        return to_route('todos.index');
    }
    public function destroy(Request $request)
    {
        $todo = Todo::find($request->todo_id);
        if (!$todo) {
            request()->session()->flash('error', 'Unable to loacate todos');

            return to_route('todos.index')->withErrors([
                'error' => 'Unable to look at todos'
            ]);
        }
        $todo->delete();
        $request->session()->flash('alert-success', 'Todos delete success');
        return to_route('todos.index');
    }
}
