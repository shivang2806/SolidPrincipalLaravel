<?php

use App\Http\Controllers\{
    ProductController,
    UserController
};
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
    return view('welcome');
});

Route::get('/index', [UserController::class, 'index']);
Route::get('/show', [UserController::class, 'show']);
Route::get('/create', [UserController::class, 'create']);
Route::post('/store', [UserController::class, 'store']);
Route::get('/edit', [UserController::class, 'edit']);
Route::post('/update', [UserController::class, 'update']);
Route::delete('/destroy', [UserController::class, 'destroy']);
Route::get('/export', [UserController::class, 'export']);

Route::get('/index', [ProductController::class, 'index']);
Route::get('/show', [ProductController::class, 'show']);
Route::post('/store', [ProductController::class, 'store']);
Route::post('/update', [ProductController::class, 'update']);
Route::delete('/destroy', [ProductController::class, 'destroy']);
