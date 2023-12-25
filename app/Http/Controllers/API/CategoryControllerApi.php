<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryControllerApi extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::paginate();

        return response()->json($categories);
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('store', Category::class);
        $category = Category::where('name', $request->name)->first();

        if ($category) {
            $category->update(['user_id' => $request->user_id]);

            return response()->json($category, Response::HTTP_OK);
        }

        $newCategory = Category::create([
            'name' => $request->name,
            'user_id' => $request->user_id
        ]);

        return response()->json($newCategory, Response::HTTP_CREATED);
    }


    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
