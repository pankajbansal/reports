<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate-report/{userId}', [ReportController::class, 'generateReportForUser']);
Route::get('/test-queue/{userId}', [ReportController::class, 'testQueue']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/profile/update', [UserController::class, 'updateProfile']);
