<?php

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
Route::get('/', [App\Http\Controllers\Api\IndexController::class, 'index']);
Route::get('announcements/{id}', [App\Http\Controllers\Api\IndexController::class, 'announcements']);
Route::get('daily_reports/{user_id}', [App\Http\Controllers\Api\IndexController::class, 'daily_reports']);
Route::post('daily/create', [App\Http\Controllers\Api\IndexController::class, 'daily_create']);
Route::post('daily/edit/{id}', [App\Http\Controllers\Api\IndexController::class, 'daily_update']);
Route::get('user/{user_id}', [App\Http\Controllers\Api\IndexController::class, 'user']);
Route::post('user/{user_id}/edit', [App\Http\Controllers\Api\IndexController::class, 'user_update']);