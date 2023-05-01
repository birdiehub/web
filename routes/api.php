<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::post('/auth/register', [AuthenticationController::class, "register"]);
Route::post('/auth/login', [AuthenticationController::class, "login"]);

Route::middleware('auth:api')->group(function() {
    Route::post('/auth/logout', [AuthenticationController::class, "logout"]);
    Route::post('/auth/refresh', [AuthenticationController::class, "refresh"]);
    Route::get('/auth/me', [AuthenticationController::class, "me"]);

    // Access Control
    Route::get('/users/{userId}/access', [AccessController::class, 'list'])->where('userId', '[0-9]+');
    Route::put('/users/{userId}/permissions/{name}', [AccessController::class, 'grantPermission'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);
    Route::delete('/users/{userId}/permissions/{name}', [AccessController::class, 'revokePermission'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);
    Route::put('/users/{userId}/roles/{name}', [AccessController::class, 'grantRole'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);
    Route::delete('/users/{userId}/roles/{name}', [AccessController::class, 'revokeRole'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);

    // Roles
    Route::get('/roles', [RoleController::class, 'list']);
    Route::post('/roles', [RoleController::class, 'create']);
    Route::get('/roles/{name}', [RoleController::class, 'get'])->where('name', '[a-z\-]+');
    Route::delete('/roles/{name}', [RoleController::class, 'delete'])->where('name', '[a-z\-]+');

    Route::put('/roles/{roleName}/permissions/{permissionName}', [RoleController::class, 'grantPermission'])->where(['roleName' => '[a-z\-]+', 'permissionName' => '[a-z\-]+']);
    Route::delete('/roles/{roleName}/permissions/{permissionName}', [RoleController::class, 'revokePermission'])->where(['roleName' => '[a-z\-]+', 'permissionName' => '[a-z\-]+']);

    // Permissions
    Route::get('/permissions', [PermissionController::class, 'list']);
    Route::get('/permissions/{name}', [PermissionController::class, 'get'])->where('name', '[a-z\-]+');

    // Users
    Route::get('/users', [UserController::class, 'all']);
    Route::post('/users', [UserController::class, 'create']);
    Route::get('/users/{id}', [UserController::class, 'get'])->where('id', '[0-9]+');
    Route::put('/users/{id}', [UserController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->where('id', '[0-9]+');

    // Countries
    Route::get('/countries', [CountryController::class, 'all']);
    Route::post('/countries', [CountryController::class, 'create']);
    Route::get('/countries/{id}', [CountryController::class, 'get'])->where('id', '[0-9]+');
    Route::put('/countries/{id}', [CountryController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/countries/{id}', [CountryController::class, 'delete'])->where('id', '[0-9]+');
});
