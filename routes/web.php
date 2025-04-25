<?php

use App\Http\Controllers\PermissionController;
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
});

require __DIR__ . '/auth.php';
