<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\SingUpController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => [ApiJsonResponse::class]], function () {

    //login routes
    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');
        
    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout.destroy')->middleware('auth:sanctum');

    //signup route
    Route::post('/signup', [SingUpController::class, 'store'])
        ->name('signup.store');

    


    Route::middleware('auth:sanctum')->group(function () {
        
        //user routes
        Route::singleton('profile', ProfileController::class)->only(['show', 'update']);

        Route::apiResource('posts', PostController::class);
        Route::apiResource('posts.comments', CommentController::class)->shallow();
    });
});