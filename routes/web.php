<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
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
    return view('auth.login');
});
Route::get('/detail/{id}',[ArticleController::class,'show']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//middleware cek sudah login/belum
Route::middleware('auth')->group(function () {
    //category route
    Route::get('/category',[CategoryController::class,'index']);
    Route::get('/category/create',[CategoryController::class,'create']);
    Route::post('/category/create',[CategoryController::class,'store']);
    Route::get('/category/{id}/detail',[CategoryController::class,'edit']);
    Route::put('/category/{id}',[CategoryController::class,'update']);
    Route::delete('/category/{id}',[CategoryController::class,'destroy']);
    //article route
    Route::get('/article',[ArticleController::class,'index']);
    Route::get('/article/create',[ArticleController::class,'create']);
    Route::post('/article/create',[ArticleController::class,'store']);
    Route::get('/article/{id}/detail',[ArticleController::class,'edit']);
    Route::put('/article/{id}',[ArticleController::class,'update']);
    Route::delete('/article/{id}',[ArticleController::class,'destroy']);
 });

