<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/category',[CategoryController::class,'index']);
    Route::get('/category/create',[CategoryController::class,'create']);
    Route::post('/category/create',[CategoryController::class,'store']);
    Route::get('/category/{id}/detail',[CategoryController::class,'edit']);
    Route::put('/category/{id}',[CategoryController::class,'update']);
    Route::delete('/category/{id}',[CategoryController::class,'destroy']);
 });
//middleware pasang
