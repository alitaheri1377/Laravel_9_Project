<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::group(["middleware"=>"authCheck2"], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});


Route::get('/posts/trash', [PostController::class, 'trashed'])->name('posts.trashed');
Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/posts/{post}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force_delete');

Route::resource('posts', PostController::class);

Route::get('/unavailable', function () {
    return view('unavailable');
})->name('unavailable');
