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
    Route::get('/subscribed', 'SubscribedController')->middleware('auth')->name('posts.subscribed');
    Route::get('/create', 'CreateController')->name('posts.create');
    Route::post('', 'StoreController')->middleware('auth')->name('posts.store');
    Route::get('/{post}', 'ShowController')->name('posts.show');
    Route::get('/{post}/edit','EditController')->middleware(['auth','post.owner'])->name('posts.edit');
    Route::patch('/{post}/toggle','ToggleController')->middleware(['auth','post.owner'])->name('posts.toggle');
    Route::patch('/{post}', 'UpdateController')->middleware(['auth','post.owner'])->name('posts.update');
    Route::delete('/{post}','DestroyController')->middleware(['auth','post.owner'])->name('posts.destroy');
    Route::delete('/{post}/image','DestroyImageController')->middleware(['auth','post.owner'])->name('posts.image.destroy');
});

Route::group(['namespace' => 'App\Http\Controllers\Comment', 'prefix' => '/comment'],function (){
    Route::post('/{comment}/like','LikeController@like')->middleware('auth')->name('comment.like');
    Route::post('/{comment}/dislike','LikeController@dislike')->middleware('auth')->name('comment.dislike');
    Route::post('/{post}','StoreController')->middleware('auth')->name('comment.store');
    Route::get('/{comment}','ShowController')->name('comment.show');
    Route::delete('/{comment}','DestroyController')->middleware('auth','comment.owner')->name('comment.destroy');
});


Route::group(['namespace' => 'App\Http\Controllers\Profile', 'prefix' => '/profile', 'middleware' => ['auth']],function () {
    Route::get('/posts', 'PostsController')->name('posts.profile');
    Route::get('', 'IndexController')->name('index.profile');
    Route::post('/update', 'UpdateController')->name('update.profile');
    Route::get('/{user}','ShowController')->name('show.profile');
});

Route::group(['namespace' => 'App\Http\Controllers\Blog', 'prefix' => '/blog'],function () {
    Route::get('', 'IndexController')->name('index.blog');
});


Route::group(['namespace' => 'App\Http\Controllers\Notify', 'prefix' => '/notifies'], function () {
    Route::get('', 'IndexController')->middleware('auth')->name('notifies.index');
    Route::delete('/{notify}', 'DestroyController')->middleware('auth','notify.owner')->name('notifies.destroy');
});

Route::group(['namespace' => 'App\Http\Controllers\Subscribe', 'prefix' => '/subscribe', 'middleware' => ['auth']],function () {
    Route::get('', 'IndexController')->name('index.subscribe');
    Route::delete('/{user}', 'DestroyController')->name('destroy.subscribe');
    Route::post('/{user}', 'StoreController')->name('store.subscribe');
    Route::post('/{user}/notify','NotifyToggleController')->middleware('subscribed')->name('notify.toggle.subscribe');
});
