<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppealController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AttractionController;

Route::group(['controller' => UserController::class, 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('{id}', 'update')->name('update');
    Route::delete('{id}', 'destroy')->name('delete');
});

Route::group(['controller' => NewsController::class, 'prefix' => 'news', 'as' => 'news.'], function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('{id}', 'update')->name('update');
    Route::delete('{id}', 'destroy')->name('delete');
});

Route::group(['controller' => ServiceController::class, 'prefix' => 'service', 'as' => 'service.'], function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('{id}', 'update')->name('update');
    Route::delete('{id}', 'destroy')->name('delete');
});

Route::group(['controller' => AttractionController::class, 'prefix' => 'attraction', 'as' => 'attraction.'], function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('{id}', 'update')->name('update');
    Route::delete('{id}', 'destroy')->name('delete');
});

Route::group(['controller' => AppealController::class, 'prefix' => 'appeal', 'as' => 'appeal.'], function () {
    Route::get('', 'index')->name('index');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('{id}', 'update')->name('update');
    Route::delete('{id}', 'destroy')->name('delete');
});


