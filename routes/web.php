<?php

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


Auth::routes();

// Стартовая страница
Route::get('/', [App\Http\Controllers\MainController::class, 'index1'])->name('index');

// Страница корзины
Route::get('/basket', [App\Http\Controllers\HomeController::class, 'basket'])->name('basket');

// Страница отдельной категории
Route::get('/{cat}', [App\Http\Controllers\MainController::class, 'showCategory'])->name('showCategory');

// Для функции в корзине
Route::post('/add/{id}', [App\Http\Controllers\BasketController::class, 'basketAddBasket'])->name('basket-add-basket');

//Для функций корзины
Route::group(['prefix' => 'basket',],function(){
        Route::group([
    ], function() {
               
        Route::post('/add/{id}', [App\Http\Controllers\BasketController::class, 'basketAdd'])->name('basket-add');
        
        Route::get('/', [App\Http\Controllers\BasketController::class, 'basket'])->name('basket');
        
        Route::post('/remove/{id}', [App\Http\Controllers\BasketController::class, 'basketRemove'])->name('basket-remove');
        Route::post('/place', [App\Http\Controllers\BasketController::class, 'basketConfirm'])->name('basket-confirm');
    });
});
