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

Route::post('/token', 'Api\Auth\LoginController@login');
Route::post('/refresh', 'Api\Auth\LoginController@refresh');
Route::post('/test', 'UssdController@index');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', function (Request $request) { return $request->user(); });

    Route::post('/course/store', 'Api\CourseController@store');
    Route::get('/course/{course}', 'Api\CourseController@show');
    Route::patch('/course/{course}', 'Api\CourseController@update');
    Route::get('/courses', 'Api\CourseController@index');
    Route::delete('/courses/{course}', 'Api\CourseController@destroy');

    Route::post('/subtopic/store', 'Api\SubTopicController@store');
    Route::patch('/subtopic/{subTopic}', 'Api\SubTopicController@update');
    Route::delete('/subtopic/{subTopic}', 'Api\SubTopicController@destroy');

    Route::post('/faq/store', 'Api\FAQController@store');
    Route::get('/faq/{fAQ}', 'Api\FAQController@show');
    Route::patch('/faq/{fAQ}', 'Api\FAQController@update');
    Route::get('/faqs', 'Api\FAQController@index');
    Route::delete('/faq/{fAQ}', 'Api\FAQController@destroy');
    

});
