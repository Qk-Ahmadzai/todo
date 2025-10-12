<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:categories']);
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show($id)
    {
        // return response()->json(Category::findOrFail($id));
        $category = Category::with('todos')->findOrFail($id);

        return response()->json([
            'category' => $category->name,
            'todos' => $category->todos
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
