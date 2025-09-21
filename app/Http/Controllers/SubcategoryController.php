<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->paginate(12);
        return view('subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
    }

    public function store(StoreSubcategoryRequest $request)
    {
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        $base = $slug;
        $i = 1;
        while (Subcategory::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $data['slug'] = $slug;
        Subcategory::create($data);
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(StoreSubcategoryRequest $request, Subcategory $subcategory)
    {
        $data = $request->validated();
        $slug = Str::slug($data['name']);
        $base = $slug;
        $i = 1;
        while (Subcategory::where('slug', $slug)->where('id', '!=', $subcategory->id)->exists()) {
            $slug = $base . '-' . $i++;
        }
        $data['slug'] = $slug;
        $subcategory->update($data);
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}
