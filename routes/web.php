<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Route::prefix('admin')->group(function(){
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::resource('/categories',App\Http\Controllers\CategoryController::class);
    Route::resource('/champions',App\Http\Controllers\ChampionController::class);
    Route::resource('/skins',App\Http\Controllers\SkinController::class);
    Route::resource('/types',App\Http\Controllers\TypeController::class);
    Route::resource('/universes',App\Http\Controllers\UniverseController::class);
}
);
