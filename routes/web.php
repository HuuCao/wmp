<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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