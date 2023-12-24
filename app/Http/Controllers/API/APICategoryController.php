<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class APICategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json(['categories' => $categories]);
    }

    public function store(Request $request)
    {

        $category = Category::create($request->all());

        return response()->json(['category' => $category], 201);
    }

    public function show(Category $category)
    {
        return response()->json(['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {

        $category->update($request->all());

        return response()->json(['category' => $category]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);
    }
}
