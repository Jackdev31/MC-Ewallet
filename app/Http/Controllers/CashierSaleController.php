<?php

namespace App\Http\Controllers;

use App\Models\CashierSale;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product;

class CashierSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::with('products')->get();
        return view('cashiersales.index', compact('products','categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CashierSale $cashierSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashierSale $cashierSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashierSale $cashierSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashierSale $cashierSale)
    {
        //
    }
}
