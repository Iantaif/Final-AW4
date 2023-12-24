<?php

namespace App\Http\Controllers\API;

use App\Models\Todo;
use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
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
        $categories = Category::all();
        if ($request->input('filter_categories')) {
            $selectedCategories = $request->input('filter_categories');
            $query->whereHas('category', function (Builder $query) use ($selectedCategories) {
                $query->whereIn('name', $selectedCategories);
            });
        }

       
    $todos = $query->simplePaginate();

    return view('todos.index', compact('todos','categories'));

    }

    public function create()
    {
        $categories = Category::all();
    return view('todos.create', compact('categories'));
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
