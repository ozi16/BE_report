<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MyClientController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\ClientUserController;

Route::post('/login', [AuthController::class, 'login']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

    // Clients
    Route::get('/me/clients', [MyClientController::class, 'index']);
    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/users/{id}/clients', [ClientController::class, 'byUserId']);
    // === add Client
    Route::post('/client/add', [ClientUserController::class, 'addUserClient']);
    // Route::post('/client/edit', [ClientController::class, 'editClient']);
    Route::post('/client/edit/{id}', [ClientUserController::class, 'editUserClient']);

    // Group
    Route::get('/groups', [GroupController::class, 'index']);
    Route::post('/group/add', [GroupUserController::class, 'store']);
    Route::delete('/group/delete/{id}', [GroupUserController::class, 'destroy']);
    Route::put('/group/edit/{id}', [GroupUserController::class, 'update']);
});
