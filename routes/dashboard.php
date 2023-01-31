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

        Route::get('/{id}/products', 'ProductController@listByCategoryId');
    });

    // Shop products
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@list');
        Route::post('/', 'ProductController@create');
        Route::get('/{id}', 'ProductController@getItem');
        Route::put('/{id}', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@delete');
    });

    // Stories
    Route::group(['prefix' => 'stories'], function () {
        Route::get('/', 'StoriesController@list');
        Route::post('/', 'StoriesController@create');
        Route::get('/{id}', 'StoriesController@getItem');
        Route::put('/{id}', 'StoriesController@update');
        Route::delete('/{id}', 'StoriesController@delete');
    });

    Route::delete('/image/{id}', 'ProductController@deleteImage');
});
