<?php

use App\Http\Controllers\AccessControl\AccessController;
use App\Http\Controllers\AccessControl\PermissionController;
use App\Http\Controllers\AccessControl\RoleController;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Countries\CountryController;
use App\Http\Controllers\Users\UserController;
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
});


//  countries
Route::middleware(['auth:api', 'permission:view-countries'])->group(function() {
    Route::get('/countries', [CountryController::class, 'all']);
    Route::get('/countries/list', [CountryController::class, 'list']);
    Route::get('/countries/{id}', [CountryController::class, 'get'])->where('id', '[0-9]+');
});

Route::middleware(['auth:api', 'permission:create-countries'])->group(function() {
    Route::post('/countries', [CountryController::class, 'create']);
});

Route::middleware(['auth:api', 'permission:edit-countries'])->group(function() {
    Route::put('/countries/{id}', [CountryController::class, 'update'])->where('id', '[0-9]+');
});

Route::middleware(['auth:api', 'permission:delete-countries'])->group(function() {
    Route::delete('/countries/{id}', [CountryController::class, 'delete'])->where('id', '[0-9]+');
});


// Users
Route::middleware(['auth:api', 'permission:view-self'])->group(function() {
    Route::get('/auth/me', [AuthenticationController::class, "me"]);
});

Route::middleware(['auth:api', 'permission:view-users'])->group(function() {
    Route::get('/users', [UserController::class, 'all']);
});

Route::middleware(['auth:api', 'permission:view-users|view-self'])->group(function() {
    Route::get('/users/{id}', [UserController::class, 'get'])->where('id', '[0-9]+');
});

Route::middleware(['auth:api', 'permission:edit-users|edit-self'])->group(function() {
    Route::put('/users/{id}', [UserController::class, 'update'])->where('id', '[0-9]+');
});

Route::middleware(['auth:api', 'permission:delete-users|delete-self'])->group(function() {
    Route::delete('/users/{id}', [UserController::class, 'delete'])->where('id', '[0-9]+');
});


// Permissions
Route::middleware(['auth:api', 'permission:view-permissions'])->group(function() {
    Route::get('/permissions', [PermissionController::class, 'list']);
    Route::get('/permissions/{name}', [PermissionController::class, 'get'])->where('name', '[a-z\-]+');
});

Route::middleware(['auth:api', 'permission:create-permissions'])->group(function() {
    Route::post('/permissions', [PermissionController::class, 'create']);
});

Route::middleware(['auth:api', 'permission:edit-permissions'])->group(function() {
    // route
});

Route::middleware(['auth:api', 'permission:delete-permissions'])->group(function() {
    Route::delete('/permissions/{name}', [PermissionController::class, 'delete'])->where('name', '[a-z\-]+');
});


// Roles
Route::middleware(['auth:api', 'permission:view-roles'])->group(function() {
    Route::get('/roles', [RoleController::class, 'list']);
    Route::get('/roles/{name}', [RoleController::class, 'get'])->where('name', '[a-z\-]+');
});

Route::middleware(['auth:api', 'permission:create-roles'])->group(function() {
    Route::post('/roles', [RoleController::class, 'create']);
});

Route::middleware(['auth:api', 'permission:edit-roles'])->group(function() {
    Route::put('/roles/{roleName}/permissions/{permissionName}', [RoleController::class, 'grantPermission'])->where(['roleName' => '[a-z\-]+', 'permissionName' => '[a-z\-]+']);
    Route::delete('/roles/{roleName}/permissions/{permissionName}', [RoleController::class, 'revokePermission'])->where(['roleName' => '[a-z\-]+', 'permissionName' => '[a-z\-]+']);
});

Route::middleware(['auth:api', 'permission:delete-roles'])->group(function() {
    Route::delete('/roles/{name}', [RoleController::class, 'delete'])->where('name', '[a-z\-]+');
});


// Access Control
Route::middleware(['auth:api', 'permission:view-user-access'])->group(function() {
    Route::get('/users/{userId}/access', [AccessController::class, 'list'])->where('userId', '[0-9]+');
});

Route::middleware(['auth:api', 'permission:grant-user-permissions'])->group(function() {
    Route::put('/users/{userId}/permissions/{name}', [AccessController::class, 'grantPermission'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);
});

Route::middleware(['auth:api', 'permission:revoke-user-permissions'])->group(function() {
    Route::delete('/users/{userId}/permissions/{name}', [AccessController::class, 'revokePermission'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);
});


Route::middleware(['auth:api', 'permission:grant-user-roles'])->group(function() {
    Route::put('/users/{userId}/roles/{name}', [AccessController::class, 'grantRole'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);
});

Route::middleware(['auth:api', 'permission:revoke-user-roles'])->group(function() {
    Route::delete('/users/{userId}/roles/{name}', [AccessController::class, 'revokeRole'])->where(['userId' => '[0-9]+', 'name' => '[a-z\-]+']);
});


