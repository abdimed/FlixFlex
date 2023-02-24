<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TitleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Auth Routes
Route::controller(AuthController::class)
    ->group(function () {
        Route::Post('/register', 'register')->name('register');
        Route::Post('/login', 'login')->name('login');
    });


// Title resource Routes
Route::apiResource('/titles', TitleController::class)->only(['index', 'show']);
Route::get('/search', [TitleController::class, 'search'])->name('titles.search');
Route::get('/titles/{title}/trailer', [TitleController::class, 'trailer'])->name('titles.trailer');


// Favorites Routes
Route::controller(FavoriteController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/user/favorites', 'index');
        Route::post('/user/favorites/{title_id}/store', 'store');
        Route::post('/user/favorites/{title_id}/delete', 'delete');
    });
