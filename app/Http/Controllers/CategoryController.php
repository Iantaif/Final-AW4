<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    
    
    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $user = Auth::user();

        $category = Category::create([
            'name' => $request->name,
            'user_id' => $user->id,
        ]);
        

        return redirect()->route('todos.index')->with('success', 'Category created successfully');
    }

    public function destroy(Category $category)
    {

        if ($category->user_id == auth()->id()) {
            $category->delete();
            return redirect()->route('todos.index')->with('success', 'Category deleted successfully');
        }


        return redirect()->route('todos.index')->with('success', 'Category deleted successfully');
    }
}
