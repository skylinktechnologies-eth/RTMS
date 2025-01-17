<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DisposeController;
use App\Http\Controllers\IssuingController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\OtherStaffController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyItemController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaitstaffAssignmentController;
use App\Http\Controllers\WaitstaffController;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use App\Models\User;

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

// Route::redirect(uri: '/', destination: 'dashboard');
Route::get('/', function () {
    $users = User::all();
    return view('welcome',compact('users'));
});
Route::get('/dashboard', function () {
    $order = Order::all()->count();
    $product = MenuItem::all()->count();
    $sales = OrderItem::all();
    return view('dashboard', compact('order', 'product', 'sales'));
    Route::get('/test', 'TestController@index')->name('test.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

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
        Route::get('changeStatusToConfirmed/{id}', 'changeStatusToConfirmed');
        Route::get('changeStatusToCancelled/{id}', 'changeStatusToCancelled');
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
        Route::get('changeStatusClose-{id}', 'changeStatusClose');
    });

    //OrderItem
    Route::controller(OrderItemController::class)->group(function () {
        Route::get('orderItem', 'index')->name('orderItem.index');
        Route::get('orderItem-create', 'create')->name('orderItem.create');
        Route::get('orderItem-edit/{id}', 'edit')->name('orderItem.edit');
        Route::post('orderItem-store', 'store')->name('orderItem.store');
        Route::put('orderItem-update/{id}', 'update')->name('orderItem.update');
        Route::delete('orderItem-delete/{id}', 'destroy')->name('orderItem.destroy');
        Route::get('changeStatusToServe-{id}', 'changeStatusToServe');
    });

    //waitstaff
    Route::controller(WaitstaffController::class)->group(function () {
        Route::get('waitstaff', 'index')->name('waitstaff.index');
        Route::get('waitstaff-create', 'create')->name('waitstaff.create');
        Route::get('waitstaff-edit/{id}', 'edit')->name('waitstaff.edit');
        Route::get('waitstaff-view/{id}', 'view')->name('waitstaff.view');
        Route::post('waitstaff-store', 'store')->name('waitstaff.store');
        Route::put('waitstaff-update/{id}', 'update')->name('waitstaff.update');
        Route::delete('waitstaff-delete/{id}', 'destroy')->name('waitstaff.destroy');
    });

    //otherstaff
    Route::controller(OtherStaffController::class)->group(function () {
        Route::get('otherstaff', 'index')->name('otherstaff.index');
        Route::get('otherstaff-create', 'create')->name('otherstaff.create');
        Route::get('otherstaff-edit/{id}', 'edit')->name('otherstaff.edit');
        Route::post('otherstaff-store', 'store')->name('otherstaff.store');
        Route::put('otherstaff-update/{id}', 'update')->name('otherstaff.update');
        Route::delete('otherstaff-delete/{id}', 'destroy')->name('otherstaff.destroy');
    });

    //waitstaff Assignment
    Route::controller(WaitstaffAssignmentController::class)->group(function () {
        Route::get('waitstaffAssignment', 'index')->name('waitstaffAssignment.index');
        Route::get('waitstaffAssignment-create', 'create')->name('waitstaffAssignment.create');
        Route::get('waitstaffAssignment-edit/{id}', 'edit')->name('waitstaffAssignment.edit');
        Route::post('waitstaffAssignment-store/{id}', 'store')->name('waitstaffAssignment.store');
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

    //itemCategory
    Route::controller(ItemCategoryController::class)->group(function () {
        Route::get('itemCategory', 'index')->name('itemCategory.index');
        Route::get('itemCategory-create', 'create')->name('itemCategory.create');
        Route::get('itemCategory-edit/{id}', 'edit')->name('itemCategory.edit');
        Route::post('itemCategory-store', 'store')->name('itemCategory.store');
        Route::put('itemCategory-update/{id}', 'update')->name('itemCategory.update');
        Route::delete('itemCategory-delete/{id}', 'destroy')->name('itemCategory.destroy');
    });

    //location
    Route::controller(LocationController::class)->group(function () {
        Route::get('location', 'index')->name('location.index');
        Route::get('location-create', 'create')->name('location.create');
        Route::get('location-edit/{id}', 'edit')->name('location.edit');
        Route::post('location-store', 'store')->name('location.store');
        Route::put('location-update/{id}', 'update')->name('location.update');
        Route::delete('location-delete/{id}', 'destroy')->name('location.destroy');
    });
    //Purchase
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('purchase', 'index')->name('purchase.index');
        Route::get('purchase-create', 'create')->name('purchase.create');
        Route::get('purchase-edit/{id}', 'edit')->name('purchase.edit');
        Route::post('purchase-store', 'store')->name('purchase.store');
        Route::put('purchase-update/{id}', 'update')->name('purchase.update');
        Route::delete('purchase-delete/{id}', 'destroy')->name('purchase.destroy');
        Route::get('changeStatusToReceived-{id}', 'changeStatusToReceived');
        Route::get('changeStatusToPlaced-{id}', 'changeStatusToPlaced');
    });
    //Issuing
    Route::controller(IssuingController::class)->group(function () {
        Route::get('issuing', 'index')->name('issuing.index');
        Route::get('issuing-create', 'create')->name('issuing.create');
        Route::get('issuing-edit/{id}', 'edit')->name('issuing.edit');
        Route::post('issuing-store', 'store')->name('issuing.store');
        Route::put('issuing-update/{id}', 'update')->name('issuing.update');
        Route::delete('issuing-delete/{id}', 'destroy')->name('issuing.destroy');
    });
    //Issuing
    Route::controller(DisposeController::class)->group(function () {
        Route::get('disposing', 'index')->name('disposing.index');
        Route::get('disposing-create', 'create')->name('disposing.create');
        Route::get('disposing-edit/{id}', 'edit')->name('disposing.edit');
        Route::post('disposing-store', 'store')->name('disposing.store');
        Route::put('disposing-update/{id}', 'update')->name('disposing.update');
        Route::delete('disposing-delete/{id}', 'destroy')->name('disposing.destroy');
    });
    //kitchen
    Route::controller(KitchenController::class)->group(function () {
        Route::get('kitchen', 'index')->name('kitchen.index');
        Route::get('changeStatusToPreparing-{id}', 'changeStatusToPreparing');
        Route::get('changeStatusToReady-{id}', 'changeStatusToReady');
    });
    //Report
    Route::controller(ReportController::class)->group(function () {
        Route::get('report', 'index')->name('report.index');
        Route::get('PurchaseReport', 'purchase')->name('report.purchase');
        Route::get('inventoryReport', 'inventory')->name('report.inventory');
    });
});


require __DIR__ . '/auth.php';
