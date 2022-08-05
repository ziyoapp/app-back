<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

//Route::group([], function() {

    // News
    Route::group(['prefix' => 'news'], function() {
        Route::get('/', 'NewsController@latest');
        Route::get('{id}', 'NewsController@newItem');
    });
//});
