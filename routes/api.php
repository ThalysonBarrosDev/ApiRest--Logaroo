<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\AuthController;

Route::prefix('v1/')->group(function () {

    Route::get('status', function () {
        return response()->json(['api_name' => 'apirest-logaroo', 'status' => true], 200);
    });

    /* Route Authentication */
    Route::post('auth/login', [AuthController::class, 'login']);

});
