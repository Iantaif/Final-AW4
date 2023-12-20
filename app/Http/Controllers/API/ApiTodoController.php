<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;

class ApiTodoController extends Controller
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
            'is_completed' => 0,
        ]);

        return response()->json($todo, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($todo);
    }

    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], Response::HTTP_NOT_FOUND);
        }

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed,
        ]);

        return response()->json($todo);
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], Response::HTTP_NOT_FOUND);
        }

        $todo->delete();

        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
