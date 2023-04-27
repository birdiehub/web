<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryApiController;
use App\Http\Controllers\UserApiController;
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

Route::post('/auth/register', [AuthController::class, "register"]);
Route::post('/auth/login', [AuthController::class, "login"]);

Route::get('/users', [UserApiController::class, 'all']);
Route::get('/users/{id}', [UserApiController::class, 'get'])->where('id', '[0-9]+');
Route::put('/users/{id}', [UserApiController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/users/{id}', [UserApiController::class, 'delete'])->where('id', '[0-9]+');


Route::get('/countries', [CountryApiController::class, 'all']);
Route::get('/countries/list', [CountryApiController::class, 'list']);
Route::post('/countries', [CountryApiController::class, 'create']);
Route::get('/countries/{id}', [CountryApiController::class, 'get'])->where('id', '[0-9]+');
Route::put('/countries/{id}', [CountryApiController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/countries/{id}', [CountryApiController::class, 'delete'])->where('id', '[0-9]+');
