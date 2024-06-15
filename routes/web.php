<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('/wc/v3/users', 'UserController@index');
Route::get('admin', [AuthController::class, 'login_admin']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);


Route::group(['shop_manager'],function () {
    Route::get('shop_manager/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('shop_manager/product/list', [ProductController::class, 'list']);
    Route::get('shop_manager/product/add', [ProductController::class, 'add']);
    Route::post('shop_manager/product/add', [ProductController::class, 'insert']);
    Route::get('shop_manager/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('shop_manager/product/edit/{id}', [ProductController::class, 'update']);
    Route::get('shop_manager/product/delete/{id}', [ProductController::class, 'delete']);
});

