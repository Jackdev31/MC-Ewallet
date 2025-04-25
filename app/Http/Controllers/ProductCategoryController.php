<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategory\StoreProductCategoryRequest;
use App\Http\Requests\ProductCategory\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductCategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view product category', only: ['index']),
            new Middleware('permission:create product category', only: ['create']),
            new Middleware('permission:edit product category', only: ['edit']),
            new Middleware('permission:delete product category', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all product categories, ordered by newest first
        $categories = ProductCategory::orderBy('created_at', 'desc')->get();

        // Return to the index view with the categories
        return view('productcategory.index', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show the form to create a new product category
        return view('productcategory.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        // At this point, $request->validated() contains only ['name' => '...'] and is already valid.
        ProductCategory::create($request->validated());

        return redirect()
            ->route('product-categories.index')
            ->with('success', 'Product category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        // Display a single product category
        return view('productcategory.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('productcategory.edit', compact('productCategory'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validated());

        return redirect()->route('product-categories.index')->with('success', 'Product category updated successfully.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('product-categories.index')->with('danger', 'Product category deleted successfully.');
    }
}
