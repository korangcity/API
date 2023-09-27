<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',

], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');

    Route::get('/products',[ProductController::class,'index']);
    Route::post('/product/create',[ProductController::class,'store']);
    Route::get('/product/{id}',[ProductController::class,'show']);
    Route::put('/product/{id}',[ProductController::class,'update']);
    Route::delete('/product/{id}',[ProductController::class,'destroy']);

    Route::post('order/create',[OrderController::class,'store']);
    Route::get('orders',[OrderController::class,'index']);
    Route::get('order/{id}',[OrderController::class,'show']);
    Route::put('order',[OrderController::class,'update']);
    Route::delete('order/{id}',[OrderController::class,'destroy']);

});
