<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->latest()->paginate(12);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        $base = $slug;
        $i = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $data['slug'] = $slug;
        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        $base = $slug;
        $i = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $data['slug'] = $slug;
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
