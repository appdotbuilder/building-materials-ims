<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Inventory Management System - Main Dashboard
Route::get('/', [App\Http\Controllers\InventoryController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // Inventory Management Routes
    Route::controller(App\Http\Controllers\InventoryController::class)->group(function () {
        Route::get('/inventory', 'show')->name('inventory.show');
        Route::post('/inventory', 'store')->name('inventory.store');
    });

    // Products Management
    Route::resource('products', App\Http\Controllers\ProductController::class);

    // Warehouses Management
    Route::resource('warehouses', App\Http\Controllers\WarehouseController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
