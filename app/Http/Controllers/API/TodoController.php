<?php

namespace App\Http\Controllers\API;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;



class TodoController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->input('user_id', auth()->id());
        $selectedCategories = $request->input('filter_categories', []);

        $todos = Todo::where('user_id', $user_id)
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->when($selectedCategories, function ($query) use ($selectedCategories) {
                $query->whereHas('category', function ($categoryQuery) use ($selectedCategories) {
                    $categoryQuery->whereIn('name', $selectedCategories);
                });
            })
            ->get();

        $categories = Category::where('user_id', $user_id)->get();

        return view('todos.index', [
            'todos' => $todos,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();

        return view('todos.create', compact('categories'));
    }

    public function store(TodoRequest $request)
    {


        $user_id = auth()->id();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' =>  [
                'nullable',
                Rule::exists('categories', 'id')->where(function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                }),
            ],
        ]);

        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id;

        Todo::factory()->create($validatedData);

        $request->session()->flash('alert-success', 'Todo created Successfully');

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
