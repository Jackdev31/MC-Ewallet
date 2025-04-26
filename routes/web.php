<?php

use App\Http\Controllers\CashierSaleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*Permission Routes*/

    // Display list of permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

    // Show the form to create a new permission
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');

    // Store a new permission
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');

    // Show the form to edit an existing permission
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');

    // Update an existing permission
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');

    // Delete a permission
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');

    /* Role Routes */

    // Display list of roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');

    // Show the form to create a new role
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');

    // Store a new role
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

    // Show the form to edit an existing role
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');

    // Update an existing role
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');

    // Delete a role
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Show a specific role
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');


    /* User Routes */

    // Display list of users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Show the form to create a new user
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // Store a new user
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Show a specific user
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    // Show the form to edit an existing user
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Update an existing user
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Delete a user
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    // ProductCategory Routes

    // List all product categories
    Route::get('/product-categories', [ProductCategoryController::class, 'index'])
        ->name('product-categories.index');

    // Show the form to create a new product category
    Route::get('/product-categories/create', [ProductCategoryController::class, 'create'])
        ->name('product-categories.create');

    // Store a new product category
    Route::post('/product-categories', [ProductCategoryController::class, 'store'])
        ->name('product-categories.store');

    // Show a specific product category
    Route::get('/product-categories/{productCategory}', [ProductCategoryController::class, 'show'])
        ->name('product-categories.show');

    // Show the form to edit an existing product category
    Route::get('/product-categories/{productCategory}/edit', [ProductCategoryController::class, 'edit'])
        ->name('product-categories.edit');

    // Update an existing product category
    Route::put('/product-categories/{productCategory}', [ProductCategoryController::class, 'update'])
        ->name('product-categories.update');

    // Delete a product category
    Route::delete('/product-categories/{productCategory}', [ProductCategoryController::class, 'destroy'])
        ->name('product-categories.destroy');


    // List all products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Show form to create a new product
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

    // Store a new product
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Show a specific product
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Show form to edit a specific product
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Update a specific product
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    // Delete a specific product
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


    
    Route::get('/cashierpos', [CashierSaleController::class, 'index'])->name('cashierpos.index');

    Route::post('/store-cashier-sales', [CashierSaleController::class, 'store'])->name('store.cashier.sales');

    Route::get('/sales-transactions', [CashierSaleController::class, 'sales'])->name('sales.transactions');


});

require __DIR__ . '/auth.php';
