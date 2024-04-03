<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Post\LikeController;
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

Route::get('/', function () {
    return redirect()->route('posts.index');

});

Route::controller(RegistrationController::class)->middleware('guest')->group(function () {
    Route::get('/reg', 'create')->name('reg.create');
    Route::post('/reg', 'store')->name('reg.store');
});

Route::controller(LoginController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'create')->name('login.create');
    Route::post('/login', 'store')->name('login.store');
});


Route::post('/logout','App\Http\Controllers\Auth\LogOutController')->middleware('auth')->name('logout');


Route::group(['namespace' => 'App\Http\Controllers\Post', 'prefix' => 'posts'], function () {
    Route::post('/{post}/like',[LikeController::class,'like'])->middleware('auth')->name('posts.like');
    Route::post('/{post}/dislike',[LikeController::class,'dislike'])->middleware('auth')->name('posts.dislike');
    Route::get('', 'IndexController')->name('posts.index');
    Route::get('/create', 'CreateController')->name('posts.create');
    Route::post('', 'StoreController')->middleware('auth')->name('posts.store');
    Route::get('/{post}', 'ShowController')->name('posts.show');
    Route::get('/{post}/edit','EditController')->middleware(['auth','post.owner'])->name('posts.edit');
    Route::patch('/{post}/toggle','ToggleController')->middleware(['auth','post.owner'])->name('posts.toggle');
    Route::patch('/{post}', 'UpdateController')->middleware(['auth','post.owner'])->name('posts.update');
    Route::delete('/{post}','DestroyController')->middleware(['auth','post.owner'])->name('posts.destroy');
});

Route::group(['namespace' => 'App\Http\Controllers\Comment', 'prefix' => '/comment'],function (){
    Route::post('/{post}','StoreController')->middleware('auth')->name('comment.store');
    Route::get('/{comment}','ShowController')->name('comment.show');
});


Route::group(['namespace' => 'App\Http\Controllers\Profile', 'prefix' => '/profile', 'middleware' => ['auth']],function () {
    Route::get('/posts', 'PostsController')->name('posts.profile');
    Route::get('', 'IndexController')->name('index.profile');
    Route::post('/update', 'UpdateController')->name('update.profile');
    Route::get('/{user}','ShowController')->name('show.profile');
});
