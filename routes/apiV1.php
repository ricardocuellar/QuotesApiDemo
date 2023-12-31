<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::post('login', [AuthController::class,'login'])->name('api.v1.login');
Route::post('forget-password', [AuthController::class, 'forgetPassword'])->name('api.v1.forget-password');

Route::prefix('admin')->middleware(['auth:sanctum','isAdmin'])->group(function(){
    Route::get('quotes', [QuoteController::class, 'index'])->name('api.v1.quotes.index');
    Route::post('quotes/{quote}/accept',[QuoteController::class, 'accept'])->name('api.v1.quotes.accept');
    Route::post('quotes/{quote}/decline',[QuoteController::class, 'decline'])->name('api.v1.quotes.decline');
    
});

Route::middleware('auth:sanctum')->group(function(){

    Route::post('logout', [AuthController::class,'logout'])->name('api.v1.logout');

    Route::post('quotes', [QuoteController::class, 'store'])->name('api.v1.quotes.store');
    Route::get('quotes/{quote}',[QuoteController::class, 'show'])->name('api.v1.quotes.show');
    Route::put('quotes/{quote}',[QuoteController::class, 'update'])->name('api.v1.quotes.update');
    Route::delete('quotes/{quote}',[QuoteController::class, 'delete'])->name('api.v1.quotes.delete');

    Route::post('quotes/{quote}',[CommentController::class, 'comment'])->name('api.v1.quotes.comment');



});




