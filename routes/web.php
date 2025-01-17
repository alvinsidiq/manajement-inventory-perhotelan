<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryAllocationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\ConsumableCategoryController;
use App\Http\Controllers\ConsumableAllocationController;
use App\Http\Controllers\UnconsumableController;
use App\Http\Controllers\UnconsumableCategoryController;
use App\Http\Controllers\UnconsumableAllocationController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Routes for items, categories, suppliers
    Route::resource('items', ItemController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);

    // Resource Routes for transactions, rooms, reservations, and guests
    Route::resource('transactions', TransactionController::class);
    Route::resource('room_types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('reservations', ReservationController::class);

    // Resource Routes for inventory, consumables, and unconsumables
    Route::resource('inventory_categories', InventoryCategoryController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('inventory_allocations', InventoryAllocationController::class);
    Route::resource('consumables', ConsumableController::class);
    Route::resource('consumable_categories', ConsumableCategoryController::class);
    Route::resource('consumable_allocations', ConsumableAllocationController::class);
    Route::resource('unconsumables', UnconsumableController::class);
    Route::resource('unconsumable_categories', UnconsumableCategoryController::class);
    Route::resource('unconsumable_allocations', UnconsumableAllocationController::class);

    // Additional routes for adding stock to consumables and unconsumables
    Route::post('/consumables/{id}/add-stock', [ConsumableController::class, 'addStock'])->name('consumables.add_stock');
    Route::post('/unconsumables/{id}/add-stock', [UnconsumableController::class, 'addStock'])->name('unconsumables.add_stock');

    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/{id}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('laporan/{id}', [LaporanController::class, 'update'])->name('laporan.update');
});

require __DIR__ . '/auth.php';
