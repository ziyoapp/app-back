<?php


use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::group(['middleware' => [
    'auth', UserRole::middleware([UserRole::ADMIN, UserRole::MODERATOR, UserRole::USER])
]], function() {
    // News
    Route::group(['prefix' => 'news'], function() {
        Route::get('/', 'NewsController@latest');
        Route::get('{id}', 'NewsController@newItem');
    });

    // User
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'UserController@getUser');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/refresh-token', 'AuthController@refresh');

        Route::get('/bonus', 'BonusController@getUserBonus');
    });
});

// Auth
Route::group(['prefix' => 'user'], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
});
