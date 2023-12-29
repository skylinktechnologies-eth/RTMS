<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyItemController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\WaitstaffAssignmentController;
use App\Http\Controllers\WaitstaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 //Table
Route::controller(TableController::class)->group(function () {
    Route::get('table', 'index')->name('table.index');
    Route::post('table-store', 'store')->name('table.store');
    Route::put('table-update/{id}', 'update')->name('table.update');
    Route::delete('table-delete/{id}', 'destroy')->name('table.destroy');
});

//Reservation
Route::controller(ReservationController::class)->group(function () {
    Route::get('reservation', 'index')->name('reservation.index');
    Route::get('reservation-create', 'create')->name('reservation.create');
    Route::get('reservation-edit/{id}', 'edit')->name('reservation.edit');
    Route::post('reservation-store', 'store')->name('reservation.store');
    Route::put('reservation-update/{id}', 'update')->name('reservation.update');
    Route::delete('reservation-delete/{id}', 'destroy')->name('reservation.destroy');
});

//Category
Route::controller(CategoryController::class)->group(function () {
    Route::get('category', 'index')->name('category.index');
    Route::get('category-create', 'create')->name('category.create');
    Route::get('category-edit/{id}', 'edit')->name('category.edit');
    Route::post('category-store', 'store')->name('category.store');
    Route::put('category-update/{id}', 'update')->name('category.update');
    Route::delete('category-delete/{id}', 'destroy')->name('category.destroy');
});

//Menu item 
Route::controller(MenuItemController::class)->group(function () {
    Route::get('menuItem', 'index')->name('menuItem.index');
    Route::get('menuItem-create', 'create')->name('menuItem.create');
    Route::get('menuItem-edit/{id}', 'edit')->name('menuItem.edit');
    Route::post('menuItem-store', 'store')->name('menuItem.store');
    Route::put('menuItem-update/{id}', 'update')->name('menuItem.update');
    Route::delete('menuItem-delete/{id}', 'destroy')->name('menuItem.destroy');
});

//Order
Route::controller(OrderController::class)->group(function () {
    Route::get('order', 'index')->name('order.index');
    Route::get('order-create', 'create')->name('order.create');
    Route::get('order-edit/{id}', 'edit')->name('order.edit');
    Route::post('order-store', 'store')->name('order.store');
    Route::put('order-update/{id}', 'update')->name('order.update');
    Route::delete('order-delete/{id}', 'destroy')->name('order.destroy');
});

//OrderItem
Route::controller(OrderItemController::class)->group(function () {
    Route::get('orderItem', 'index')->name('orderItem.index');
    Route::get('orderItem-create', 'create')->name('orderItem.create');
    Route::get('orderItem-edit/{id}', 'edit')->name('orderItem.edit');
    Route::post('orderItem-store', 'store')->name('orderItem.store');
    Route::put('orderItem-update/{id}', 'update')->name('orderItem.update');
    Route::delete('orderItem-delete/{id}', 'destroy')->name('orderItem.destroy');
});

//waitstaff
Route::controller(WaitstaffController::class)->group(function () {
    Route::get('waitstaff', 'index')->name('waitstaff.index');
    Route::get('waitstaff-create', 'create')->name('waitstaff.create');
    Route::get('waitstaff-edit/{id}', 'edit')->name('waitstaff.edit');
    Route::post('waitstaff-store', 'store')->name('waitstaff.store');
    Route::put('waitstaff-update/{id}', 'update')->name('waitstaff.update');
    Route::delete('waitstaff-delete/{id}', 'destroy')->name('waitstaff.destroy');
});

//waitstaff Assignment
Route::controller(WaitstaffAssignmentController::class)->group(function () {
    Route::get('waitstaffAssignment', 'index')->name('waitstaffAssignment.index');
    Route::get('waitstaffAssignment-create', 'create')->name('waitstaffAssignment.create');
    Route::get('waitstaffAssignment-edit/{id}', 'edit')->name('waitstaffAssignment.edit');
    Route::post('waitstaffAssignment-store', 'store')->name('waitstaffAssignment.store');
    Route::put('waitstaffAssignment-update/{id}', 'update')->name('waitstaffAssignment.update');
    Route::delete('waitstaffAssignment-delete/{id}', 'destroy')->name('waitstaffAssignment.destroy');
});

//Supplier
Route::controller(SupplierController::class)->group(function () {
    Route::get('supplier', 'index')->name('supplier.index');
    Route::get('supplier-create', 'create')->name('supplier.create');
    Route::get('supplier-edit/{id}', 'edit')->name('supplier.edit');
    Route::post('supplier-store', 'store')->name('supplier.store');
    Route::put('supplier-update/{id}', 'update')->name('supplier.update');
    Route::delete('supplier-delete/{id}', 'destroy')->name('supplier.destroy');
});

//SupplyItem
Route::controller(SupplyItemController::class)->group(function () {
    Route::get('supplyItem', 'index')->name('supplyItem.index');
    Route::get('supplyItem-create', 'create')->name('supplyItem.create');
    Route::get('supplyItem-edit/{id}', 'edit')->name('supplyItem.edit');
    Route::post('supplyItem-store', 'store')->name('supplyItem.store');
    Route::put('supplyItem-update/{id}', 'update')->name('supplyItem.update');
    Route::delete('supplyItem-delete/{id}', 'destroy')->name('supplyItem.destroy');
});