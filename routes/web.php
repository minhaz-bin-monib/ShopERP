<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;

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

// ------------------------- Company Routes ------------------------

Route::group(['prefix' => 'company','middleware' => ['isLoggedIn','roleCheck:Admin,Assistant']], function () {
    Route::get('list', [CompanyController::class, 'show']);
    Route::get('create', [CompanyController::class, 'create']);
    Route::post('create', [CompanyController::class, 'store']);
    Route::get('delete/{id}', [CompanyController::class, 'delete']);
    Route::get('edit/{id}', [CompanyController::class, 'edit']);
    Route::post('update/{id}', [CompanyController::class, 'update']);

    // APIs
    Route::get('getList', [CompanyController::class, 'getList']);
});

// ------------------------- Customer Routes ------------------------

Route::group(['prefix' => 'customer','middleware' => ['isLoggedIn','roleCheck:Admin,Assistant']], function () {
    Route::get('list', [CustomerController::class, 'show']);
    Route::get('create', [CustomerController::class, 'create']);
    Route::post('create', [CustomerController::class, 'store']);
    Route::get('delete/{id}', [CustomerController::class, 'delete']);
    Route::get('edit/{id}', [CustomerController::class, 'edit']);
    Route::post('update/{id}', [CustomerController::class, 'update']);

    // APIs
    Route::get('getList', [CustomerController::class, 'getList']);
});