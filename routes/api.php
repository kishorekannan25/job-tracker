<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApplicationController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('applications', ApplicationController::class);
});

