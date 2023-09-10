<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', [DashboardController::class,'show'])->name('dashboard');
Route::get('/dashboard/search', [DashboardController::class,'search']);
Route::get('/dashboard/category/{category_id}', [DashboardController::class,'category_filter']);

Route::get('/user/{user_id}', [UserController::class,'find']);
Route::put('/user/{user_id}', [UserController::class,'update']);
Route::get('/user/{user_id}/post', [UserController::class,'filter']);

Route::get('sign-in-google', [UserController::class,'google']);
Route::get('/auth/google/callback', [UserController::class,'handleCallback']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/{user_id}', [PostController::class,'create']);

Route::post('/post/{user_id}', [PostController::class,'store']);

Route::get('/post/{post_id}/edit', [PostController::class,'edit']);

Route::put('/post/{post_id}', [PostController::class,'update']);

Route::delete('/post/{post_id}', [PostController::class,'destroy']);

Route::get('/dashboard/{post_id}', [DashboardController::class,'forum']);
Route::post('/dashboard/{post_id}', [DashboardController::class,'create']);
Route::put('/dashboard/{comment_id}', [DashboardController::class,'update']);

Route::delete('/dashboard/{comment_id}', [DashboardController::class,'destroy']);


});

Route::get('/', function(){
    return redirect('/dashboard');
});


require __DIR__.'/auth.php';
