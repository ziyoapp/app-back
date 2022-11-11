<?php

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::post('/login', 'AuthController@dashboardLogin');

Route::group(['middleware' => [
    'auth', UserRole::middleware([UserRole::ADMIN, UserRole::MODERATOR])
]], function() {
    Route::group(['prefix' => 'news'], function () {
        Route::get('/list', 'NewsController@list');
        Route::post('/', 'NewsController@create');
        Route::get('/{id}', 'NewsController@item');
        Route::put('/{id}', 'NewsController@update');
        Route::delete('/{id}', 'NewsController@delete');
    });
});
