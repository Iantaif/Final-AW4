<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('todos.index')->with('success', 'Category created successfully');
    }

    public function destroy(Category $category)
    {


        $category->delete();

        return redirect()->route('todos.index')->with('success', 'Category deleted successfully');
    }
}
