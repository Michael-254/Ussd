<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', [App\Http\Controllers\CourseController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
