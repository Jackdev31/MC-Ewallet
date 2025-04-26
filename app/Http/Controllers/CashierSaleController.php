<?php

namespace App\Http\Controllers;

use App\Models\CashierSale;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CashierSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::with('products')->get();
        return view('cashiersales.index', compact('products', 'categories'));
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
        // Directly check if the user is authenticated (no middleware involved)
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }

        // Get the authenticated user's ID
        $user_id = Auth::id();  // Get the authenticated user's ID
        Log::info('Authenticated user ID: ' . $user_id);  // Log user ID for debugging

        // Retrieve the products and total price from the request
        $products = $request->input('products');
        $totalPrice = $request->input('total_price');

        // Log the request data for debugging
        Log::info('Request data: ', $request->all());

        // Start a database transaction to ensure consistency
        DB::beginTransaction();

        try {
            // Loop through the products and create a sale for each one
            foreach ($products as $productData) {
                // Log product data for debugging
                Log::info('Processing product: ', $productData);

                // Create a new sale record and store the user_id
                CashierSale::create([
                    'product_id' => $productData['product_id'],
                    'quantity' => $productData['quantity'],
                    'total_price' => $productData['total_price'],
                    'user_id' => $user_id,  // Assign the authenticated user ID
                ]);

                // Update the product quantity
                $product = Product::find($productData['product_id']);
                if ($product) {
                    $product->quantity -= $productData['quantity'];
                    $product->save();
                }
            }

            // Commit the transaction if everything works
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            Log::error('Error during transaction: ' . $e->getMessage());  // Log the error
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function sales()
    {
        // Retrieve all sales with associated product and user (cashier) details
        $sales = CashierSale::with(['product', 'user'])->latest()->get();

        // Pass the sales data to the view
        return view('cashiersales.transactions', compact('sales'));
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
