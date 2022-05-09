<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TagController;

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

Route::prefix('quotes')->name('quotes.')->group(function () {
    Route::get('/', [QuoteController::class, 'index'])->name('index');
    Route::post('/', [QuoteController::class, 'createOrUpdateQuotes'])->name('createOrUpdate');

    Route::get('search', [QuoteController::class, 'searchQuotes'])->name('search');

    Route::group(['prefix' => '{id}', 'where' => ['id' => '[0-9]+']], function () {
        Route::get('/', [QuoteController::class, 'show'])->name('show');
    });
});

Route::prefix('tags')->name('tags.')->group(function () {
    Route::get('/', [TagController::class, 'index']);
});
