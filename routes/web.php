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




Route::group(['namespace' => 'App\Http\Controllers\Profile', 'middleware' => ['auth']],function () {
    Route::get('/profile/posts', 'PostsController')->name('posts.profile');
    Route::get('/profile', 'IndexController')->name('index.profile');
    Route::post('/profile/update', 'UpdateController')->name('update.profile');
    Route::get('/profile/{user}','ShowController')->name('show.profile');
});
