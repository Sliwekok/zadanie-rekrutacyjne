<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::prefix('post')->group(function(){
    Route::get('/', [PostController::class, 'test']);
    Route::get('/create', [PostController::class, 'create']);
    
    Route::prefix('{id}')->group(function(){
        Route::get('/', [PostController::class, 'show']);
        Route::post('/comment', [PostController::class, 'addComment']);
        Route::patch('/update', [PostController::class, 'update']);
    });

});

Route::prefix('comment')->group(function(){
    Route::get('/', [CommentController::class, 'showAll']);

    Route::prefix('{id}')->group(function(){
        Route::get('/', [CommentController::class, 'show']);
        Route::patch('/update', [CommentController::class, 'update']);
    });

});