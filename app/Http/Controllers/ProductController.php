<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category', 'products')->get();
        return view('products.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $slugBase = Str::slug($data['name']);
        $slug = $slugBase;
        $i = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $i++;
        }
        $data['slug'] = $slug;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();
        return view('products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // slug uniqueness (exclude current)
        $slugBase = Str::slug($data['name']);
        $slug = $slugBase;
        $i = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $slugBase . '-' . $i++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = $product->image;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }

    // helper for API: get subcategories for a category (optional)
    public function subcategoriesByCategory($categoryId)
    {
        return Subcategory::where('category_id', $categoryId)->get(['id', 'name']);
    }
}
