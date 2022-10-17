<?php


use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

Route::group(['middleware' => [
    'auth', UserRole::middleware([UserRole::ADMIN, UserRole::MODERATOR, UserRole::USER])
]], function() {
    // User
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'UserController@getUser');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/refresh-token', 'AuthController@refresh');

        Route::get('/bonus', 'BonusController@getUserBonus');
        Route::get('/qr-code', 'UserController@getQRCode');
    });

    // News
    Route::group(['prefix' => 'news'], function() {
        Route::get('/', 'NewsController@newsList');
        Route::get('{id}', 'NewsController@newItem');
        Route::get('/latest', 'NewsController@latest');
    });

    // Events
    Route::group(['prefix' => 'events'], function() {
        Route::get('/', 'EventController@eventList');
        Route::get('{id}', 'EventController@event');
        Route::get('/latest', 'EventController@latest');

        Route::post('/{id}/add-user', 'EventController@addUser');
        Route::delete('/{id}/undo-user', 'EventController@undoUser');
    });
});

// Auth
Route::group(['prefix' => 'user'], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
});
