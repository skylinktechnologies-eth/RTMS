<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
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
