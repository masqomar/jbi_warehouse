<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    MutationController,
    UserController,
    ProfileController,
    RoleAndPermissionController
};

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/profile', ProfileController::class)->name('profile');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleAndPermissionController::class);
});

require_once __DIR__ . '/generator.php';

//Pusat
Route::resource('all-products', App\Http\Controllers\AllProductController::class)->middleware('auth');



//Cabang
Route::resource('/', App\Http\Controllers\DashboardController::class)->middleware('auth');
Route::get('log-activities', [App\Http\Controllers\LogActivityController::class, 'index'])->name('activities.index')->middleware('auth');
Route::resource('carts', \App\Http\Controllers\CartController::class)->middleware('auth');
Route::post('carts/scan', [\App\Http\Controllers\CartController::class, 'scan'])->name('carts.scan')->middleware('auth');
Route::resource('companies', App\Http\Controllers\CompanyController::class)->middleware('auth');
Route::resource('categories', App\Http\Controllers\CategoryController::class)->middleware('auth');
Route::resource('units', App\Http\Controllers\UnitController::class)->middleware('auth');
Route::resource('products', App\Http\Controllers\ProductController::class)->middleware('auth');
Route::post('products/search', [\App\Http\Controllers\ProductController::class, 'search'])->name('products.search')->middleware('auth');
Route::get('out-products', [\App\Http\Controllers\OutProductController::class, 'index'])->name('out-products.index')->middleware('auth');
Route::get('transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index')->middleware('auth');
Route::get('transactions/{transaction}/print_struck', [\App\Http\Controllers\TransactionController::class, 'print_struck'])->name('transactions.print_struck')->middleware('auth');
Route::post('transactions', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store')->middleware('auth');
Route::get('transactions/{transaction}', [\App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show')->middleware('auth');
Route::delete('transactions/{transaction}', [\App\Http\Controllers\TransactionController::class, 'destroy'])->name('transactions.destroy')->middleware('auth');
Route::resource('suppliers', App\Http\Controllers\SupplierController::class)->middleware('auth');
Route::resource('coming-products', App\Http\Controllers\ComingProductController::class)->middleware('auth');
Route::resource('buildings', App\Http\Controllers\BuildingController::class)->middleware('auth');
Route::resource('rooms', App\Http\Controllers\RoomController::class)->middleware('auth');
Route::post('rooms/import', [App\Http\Controllers\RoomController::class, 'import'])->name('rooms.import');
Route::resource('devisions', App\Http\Controllers\DevisionController::class)->middleware('auth');
Route::resource('programs', App\Http\Controllers\ProgramController::class)->middleware('auth');
Route::resource('members', App\Http\Controllers\MemberController::class)->middleware('auth');
Route::resource('assets', App\Http\Controllers\AssetController::class)->middleware('auth');
Route::resource('placements', App\Http\Controllers\PlacementController::class)->middleware('auth');
Route::resource('permissions', App\Http\Controllers\PermissionController::class)->middleware('auth');
Route::get('mutations/cart', [MutationController::class, 'cart'])->name('mutations.cart');
Route::get('mutations/add-to-cart/{id}', [MutationController::class, 'addToCart'])->name('mutations.add.to.cart');
Route::delete('mutations/remove-from-cart', [MutationController::class, 'remove'])->name('mutations.remove.from.cart');
Route::resource('mutations', App\Http\Controllers\MutationController::class)->middleware('auth');
Route::resource('asset-maintenances', App\Http\Controllers\AssetMaintenanceController::class)->middleware('auth');
Route::resource('procurements', App\Http\Controllers\ProcurementController::class)->middleware('auth');

//Laporan Cabang
Route::get('inventory-report', [App\Http\Controllers\LaporanPersediaanController::class, 'index'])->name('reports.index')->middleware('auth');

Route::get('students', [App\Http\Controllers\StudentController::class, 'index'])->name('students');
Route::get('standards', [App\Http\Controllers\StudentController::class, 'getStandard'])->name('standards');
Route::get('results', [App\Http\Controllers\StudentController::class, 'getResult'])->name('results');
Route::get('students/records', [App\Http\Controllers\StudentController::class, 'records'])->name('students/records');

Route::resource('electricities', App\Http\Controllers\ElectricityController::class)->middleware('auth');
