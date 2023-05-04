<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
// Loại hàng
Route::group(['prefix' => '/categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/show/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/create', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/{id}/edit', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Đơn vị
Route::group(['prefix' => '/units'], function () {
    Route::get('/', [UnitController::class, 'index'])->name('units.index');
    Route::get('/show/{id}', [UnitController::class, 'show'])->name('units.show');
    Route::get('/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/create', [UnitController::class, 'store'])->name('units.store');
    Route::get('/{id}/edit', [UnitController::class, 'edit'])->name('units.edit');
    Route::post('/{id}/edit', [UnitController::class, 'update'])->name('units.update');
    Route::delete('/destroy/{id}', [UnitController::class, 'destroy'])->name('units.destroy');
});

// Nhà cung cấp
Route::group(['prefix' => '/suppliers'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/show/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/create', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::post('/{id}/edit', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/destroy/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

// Khách hàng
Route::group(['prefix' => '/customers'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/show/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/create', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/{id}/edit', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/destroy/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});