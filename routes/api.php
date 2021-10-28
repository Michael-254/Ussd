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

//Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/course/store', [App\Http\Controllers\Api\CourseController::class, 'store']);
    Route::get('/course/{course}', [App\Http\Controllers\Api\CourseController::class, 'show']);
    Route::patch('/course/{course}', [App\Http\Controllers\Api\CourseController::class, 'update']);
    Route::get('/courses', [App\Http\Controllers\Api\CourseController::class, 'index']);
    Route::delete('/courses/{course}', [App\Http\Controllers\Api\CourseController::class, 'destroy']);

    Route::post('/subtopic/store', [App\Http\Controllers\Api\SubTopicController::class, 'store']);
    Route::patch('/subtopic/{subTopic}', [App\Http\Controllers\Api\SubTopicController::class, 'update']);
    Route::delete('/subtopic/{subTopic}', [App\Http\Controllers\Api\SubTopicController::class, 'destroy']);

    Route::post('/faq/store', [App\Http\Controllers\Api\FAQController::class, 'store']);
    Route::get('/faq/{fAQ}', [App\Http\Controllers\Api\FAQController::class, 'show']);
    Route::patch('/faq/{fAQ}', [App\Http\Controllers\Api\FAQController::class, 'update']);
    Route::get('/faqs', [App\Http\Controllers\Api\FAQController::class, 'index']);
    Route::delete('/faq/{fAQ}', [App\Http\Controllers\Api\FAQController::class, 'destroy']);
    

//});
