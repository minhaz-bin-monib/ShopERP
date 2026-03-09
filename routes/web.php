<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributesController;

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
Route::get('/', [AuthController::class, 'loginForm'])->middleware('isAlredyLoggedIn');

// ---------------------------- Authentication --------------------------------

Route::get('register', [AuthController::class, 'registerForm'])->middleware('isLoggedIn');
Route::post('register', [AuthController::class, 'register'])->middleware('isLoggedIn');
Route::get('login', [AuthController::class, 'loginForm'])->middleware('isAlredyLoggedIn');
Route::post('login', [AuthController::class, 'login'])->middleware('isAlredyLoggedIn');
Route::get('logout', [AuthController::class, 'logout']);

// ------------------------- Dashboard Routes ------------------------

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('isLoggedIn');
Route::get('/unauthorized',[DashboardController::class, 'unauthorized'])->middleware('isLoggedIn');




// ------------------------- Category Routes ------------------------

Route::group(['prefix' => 'category','middleware' => ['isLoggedIn','roleCheck:Admin,Assistant']], function () {
    Route::get('list', [CategoryController::class, 'show']);
    Route::get('create', [CategoryController::class, 'create']);
    Route::post('create', [CategoryController::class, 'store']);
    Route::get('delete/{id}', [CategoryController::class, 'delete']);
    Route::get('edit/{id}', [CategoryController::class, 'edit']);
    Route::post('update/{id}', [CategoryController::class, 'update']);

    // APIs
    Route::get('getList', [CategoryController::class, 'getList']);
});

// ------------------------- Attributes Routes ------------------------

Route::group(['prefix' => 'attributes','middleware' => ['isLoggedIn','roleCheck:Admin,Assistant']], function () {
    Route::get('list', [AttributesController::class, 'show']);
    Route::get('create', [AttributesController::class, 'create']);
    Route::post('create', [AttributesController::class, 'store']);
    Route::get('delete/{id}', [AttributesController::class, 'delete']);
    Route::get('edit/{id}', [AttributesController::class, 'edit']);
    Route::post('update/{id}', [AttributesController::class, 'update']);

    // APIs
    Route::get('getList', [AttributesController::class, 'getList']);
});