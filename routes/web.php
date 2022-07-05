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

Route::get('/universes',[App\Http\Controllers\UniverseController::class,'getListUniverses'])->name('user.universes.index');
Route::get('/universes/{id}',[App\Http\Controllers\UniverseController::class,'getListCategoriesOfUniverse'])->name('user.universes.detail');
Route::get('/categories',[App\Http\Controllers\CategoryController::class,'getListCategories'])->name('user.categories.index');
Route::get('/categories/{id}',[App\Http\Controllers\CategoryController::class,'getListSkinsOfCategory'])->name('user.categories.detail');
Route::get('/types',[App\Http\Controllers\TypeController::class,'getListTypes'])->name('user.types.index');
Route::get('/types/{id}',[App\Http\Controllers\TypeController::class,'getListSkinsOfType'])->name('user.types.detail');
Route::get('/champion',[App\Http\Controllers\ChampionController::class,'getListChampions'])->name('user.champions.index');
Route::get('/champion/{id}',[App\Http\Controllers\ChampionController::class,'getListSkinsOfChampion'])->name('user.champions.detail');
Route::get('/skin',[App\Http\Controllers\SkinController::class,'getListSkins'])->name('user.skins.index');
Route::get('/skin/{id}',[App\Http\Controllers\SkinController::class,'getSkinDetail'])->name('user.skins.detail');

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
