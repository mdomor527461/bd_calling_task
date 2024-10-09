<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('admin/items/unapproved', [ItemController::class, 'getUnapproved'])->middleware('auth:api', 'role:admin');
Route::put('admin/items/{id}/approve', [ItemController::class, 'approve'])->middleware('auth:api', 'role:admin');
Route::put('admin/items/{id}/reject', [ItemController::class, 'reject'])->middleware('auth:api', 'role:admin');
