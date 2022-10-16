<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User routes
Route::controller(UserController::class)->group(function () {
    Route::post('/users/register', 'store');
    Route::post('/users/login', 'login');
});

// Card routes
Route::controller(CardController::class)->group(function () {
    Route::get('/cards/generate', 'generate');
    Route::post('/cards/save/{id}', 'store');
    Route::get('/cards/{id}', 'show');
    Route::delete('/cards/delete/{userId}/{cardId}', 'destroy');
});
