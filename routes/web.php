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
    Route::resource('/categories',App\Http\Controllers\CategoryController::class)->middleware('auth');
    Route::resource('/champions',App\Http\Controllers\ChampionController::class)->middleware('auth');
    Route::resource('/skins',App\Http\Controllers\SkinController::class)->middleware('auth');
    Route::resource('/types',App\Http\Controllers\TypeController::class)->middleware('auth');
    Route::resource('/universes',App\Http\Controllers\UniverseController::class)->middleware('auth');
    Route::post('/universes/changeStatus/{id}',[App\Http\Controllers\UniverseController::class,'changeStatus'])->name('universes.changeStatus')->middleware('auth');
    Route::post('/categories/changeStatus/{id}',[App\Http\Controllers\CategoryController::class,'changeStatus'])->name('categories.changeStatus')->middleware('auth');
    Route::post('/types/changeStatus/{id}',[App\Http\Controllers\TypeController::class,'changeStatus'])->name('types.changeStatus')->middleware('auth');
    Route::post('/champions/changeStatus/{id}',[App\Http\Controllers\ChampionController::class,'changeStatus'])->name('champions.changeStatus')->middleware('auth');
    Route::post('/skins/changeStatus/{id}',[App\Http\Controllers\SkinController::class,'changeStatus'])->name('skins.changeStatus')->middleware('auth');

}
);
