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


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('items', ItemController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);

    // Route Resource untuk Transactions
    Route::resource('transactions', TransactionController::class);

    Route::resource('room_types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);

    Route::resource('inventory_categories', InventoryCategoryController::class);
    Route::resource('inventory', InventoryController::class);
    Route::resource('inventory_allocations', InventoryAllocationController::class);

    Route::resource('guests', GuestController::class);
    Route::resource('reservations', ReservationController::class);

    Route::resource('consumables', ConsumableController::class);
    Route::post('/consumables/{id}/add-stock', [ConsumableController::class, 'addStock'])->name('consumables.add_stock');
    Route::resource('consumable_categories', ConsumableCategoryController::class);
    Route::resource('consumable_allocations', ConsumableAllocationController::class);
});





require __DIR__ . '/auth.php';
