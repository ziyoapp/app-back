<?php

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::post('/login', 'AuthController@dashboardLogin');

Route::group(['middleware' => [
    'auth', UserRole::middleware([UserRole::ADMIN, UserRole::MODERATOR])
]], function() {
    // News
    Route::group(['prefix' => 'news'], function () {
        Route::get('/list', 'NewsController@list');
        Route::post('/', 'NewsController@create');
        Route::get('/{id}', 'NewsController@item');
        Route::put('/{id}', 'NewsController@update');
        Route::delete('/{id}', 'NewsController@delete');
    });

    // Events
    Route::group(['prefix' => 'events'], function () {
        Route::get('/list', 'EventController@list');
        Route::post('/', 'EventController@create');
        Route::get('/{id}', 'EventController@item');
        Route::put('/{id}', 'EventController@update');
        Route::delete('/{id}', 'EventController@delete');
    });

    // Shop category
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'ProductCategoryController@getCategories');
        Route::post('/', 'ProductCategoryController@create');
        Route::get('/{id}', 'ProductCategoryController@getItem');
        Route::put('/{id}', 'ProductCategoryController@update');
        Route::delete('/{id}', 'ProductCategoryController@delete');
    });
});
