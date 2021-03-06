<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';



Route::middleware(['auth'])->prefix('post')->group(function(){
    Route::get('/', [PostController::class, 'showAll']);
    Route::get('/create', [PostController::class, 'create']);
    Route::post('/createPost', [PostController::class, 'createPost']);
    
    Route::prefix('{id}')->group(function(){
        Route::get('/', [PostController::class, 'show']);
        Route::get('/edit', [PostController::class, 'edit']);
        Route::post('/update', [PostController::class, 'update']);
        Route::post('/comment', [PostController::class, 'addComment']);
        Route::post('/delete', [PostController::class, 'delete']);
    });

});

Route::middleware(['auth'])->prefix('comment')->group(function(){
    Route::prefix('{id}')->group(function(){
        Route::delete('/delete', [CommentController::class, 'delete']);
    });
});

Route::middleware(['auth'])->prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'index']);

    Route::delete('/{id}/delete', [UserController::class, 'delete']);
});
