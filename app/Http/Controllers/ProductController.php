<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view products', only: ['index']),
            new Middleware('permission:create products', only: ['create']),
            new Middleware('permission:edit products', only: ['edit']),
            new Middleware('permission:delete products', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('product_images', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }


    public function show(Product $product)
    {
        // Eager load the category relationship
        $product->load('category');
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $categories = ProductCategory::all(); // Fetch all categories
        return view('products.edit', compact('product', 'categories')); // Pass categories to view
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('product_image')) {
            // Delete old image
            if ($product->product_image && file_exists(public_path('storage/' . $product->product_image))) {
                unlink(public_path('storage/' . $product->product_image));
            }

            // Store new image
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $data['product_image'] = $imagePath;
        }

        // Update all at once
        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}

