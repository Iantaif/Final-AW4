<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryControllerApi extends Controller
{
    public function index(Request $request)
    {
        $todos = Todo::paginate();
        return response()->json($todos);
    }

    public function store(TodoRequest $request)
    {
        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => false, 
        ]);

        return response()->json($todo, Response::HTTP_CREATED);
    }

    public function show(Todo $todo)
    {
        return response()->json($todo);
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->boolean('is_completed'), // Ensure it's a boolean
        ]);

        return response()->json($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
