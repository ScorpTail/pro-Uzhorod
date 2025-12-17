<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\News\NewsController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\Service\ServiceController;
use App\Http\Controllers\Api\V1\Attraction\AttractionController;

Route::group(['controller' => AuthController::class, 'middleware' => 'guest', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::group(['controller' => AuthController::class, 'middleware' => 'auth:sanctum', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('logout', 'logout')->name('logout');
});

Route::group(['controller' => UserController::class, 'middleware' => 'auth:sanctum', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('', 'show')->name('show');
    Route::post('', 'update')->name('update');
    Route::delete('delete', 'delete')->name('delete');
});

Route::group(['controller' => NewsController::class, 'prefix' => 'news', 'as' => 'news.'], function () {
    Route::get('', 'index')->name('index');
    Route::get('{id}', 'show')->name('show');
});

Route::group(['controller' => ServiceController::class, 'prefix' => 'service', 'as' => 'service.'], function () {
    Route::get('', 'index')->name('index');
    Route::get('{id}', 'show')->name('show');
});

Route::group(['controller' => AttractionController::class, 'prefix' => 'attraction', 'as' => 'attraction.'], function () {
    Route::get('', 'index')->name('index');
    Route::get('{id}', 'show')->name('show');
});
