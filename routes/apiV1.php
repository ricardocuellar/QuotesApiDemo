<?php

use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class,'store'])->name('api.v1.register');

Route::get('quotes', [QuoteController::class, 'index'])->name('api.v1.quotes.index');
Route::post('quotes', [QuoteController::class, 'store'])->name('api.v1.quotes.store');
Route::get('quotes/{quote}',[QuoteController::class, 'show'])->name('api.v1.quotes.show');
Route::put('quotes/{quote}',[QuoteController::class, 'update'])->name('api.v1.quotes.update');
Route::delete('quotes/{quote}',[QuoteController::class, 'delete'])->name('api.v1.quotes.delete');

