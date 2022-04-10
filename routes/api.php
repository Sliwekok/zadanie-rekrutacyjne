<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostAPIController;
use App\Http\Controllers\CommentAPIController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('post')->group(function(){
    Route::get('/', [PostAPIController::class, 'showAll']);
    Route::post('/create', [PostAPIController::class, 'create']);
    
    Route::prefix('{id}')->group(function(){
        Route::get('/', [PostAPIController::class, 'show']);
        Route::post('/comment', [PostAPIController::class, 'addComment']);
        Route::post('/update', [PostAPIController::class, 'update']);
        Route::delete('/delete', [PostAPIController::class, 'delete']);
    });
});

Route::prefix('comment')->group(function(){
    Route::get('/', [CommentAPIController::class, 'showAll']);

    Route::prefix('{id}')->group(function(){
        Route::get('/', [CommentAPIController::class, 'show']);
        Route::post('/update', [CommentAPIController::class, 'update']);
        Route::delete('/delete', [CommentAPIController::class, 'delete']);
    });
});
