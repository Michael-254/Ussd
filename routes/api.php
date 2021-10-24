<?php

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

Route::post('/test', [App\Http\Controllers\UssdController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/course/store', [App\Http\Controllers\CourseController::class, 'store']);
    Route::put('/course/update/{course}', [App\Http\Controllers\CourseController::class, 'update']);
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index']);
    Route::delete('/courses/{course}', [App\Http\Controllers\CourseController::class, 'destroy']);

});