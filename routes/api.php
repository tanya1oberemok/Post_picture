<?php

use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\ProfileController;
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

Route::post('auth/login', [ApiLoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index']);
});
