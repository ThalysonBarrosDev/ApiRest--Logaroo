<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\PostsController;
use App\Http\Middleware\v1\ProtectedRouteAuth;

Route::prefix('v1/')->group(function () {

    /* Route Status */
    Route::get('status', function () {
        return response()->json(['status' => true, 'api_name' => 'apirest-logaroo'], 200);
    });

    /* Route Authentication */
    Route::post('auth/login', [AuthController::class, 'login']);

    Route::middleware([ProtectedRouteAuth::class])->group(function() {

        /* Route Posts */
        Route::post('posts', [PostsController::class, 'create']);
        Route::get('posts', [PostsController::class, 'readAll']);
        Route::get('posts/{id}', [PostsController::class, 'read']);
        Route::put('posts/{id}', [PostsController::class, 'update']);
        Route::delete('posts/{id}', [PostsController::class, 'delete']);

    });

});
