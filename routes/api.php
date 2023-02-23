<?php

use App\Http\Controllers\AuthController;
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

Route::apiResource('titles', TitleController::class);

