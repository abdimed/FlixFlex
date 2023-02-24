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

Route::controller(AuthController::class)
    ->group(
        function () {
            Route::Post('/register', 'register');
            Route::Post('/login', 'login');
        }
    );


Route::apiResource('/titles', TitleController::class);

Route::get('/search', [TitleController::class, 'search']);

Route::controller(FavoriteController::class)
    ->middleware('auth:sanctum')
    ->group(
        function () {
            Route::get('/favorites', 'index');
            Route::Post('/favorites/{title_id}/store', 'store');
            Route::Post('/favorites/{title_id}/delete', 'delete');
        }
    );
