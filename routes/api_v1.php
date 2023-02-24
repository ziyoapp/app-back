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

        Route::post('/change-password', 'UserController@changePassword');

        Route::post('/update', 'UserController@userUpdate');

        Route::get('/bonus', 'BonusController@getUserBonus');
        Route::get('/qr-code', 'UserController@getQRCode');

        Route::get('/bonus-history', 'BonusController@userBonusHistory');

        Route::get('/notifications', 'UserController@notifications');
        Route::post('/notifications/{uuid}/read', 'UserController@readNotification');
        Route::post('/notifications/read-all', 'UserController@readAllNotifications');
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
        Route::get('/category', 'EventController@eventsCategory');
        Route::get('/category/{eventCategoryId}', 'EventController@categoryEvent')
            ->where('eventCategoryId', 'all|free|past|new|exclusive');

        Route::post('/{id}/add-user', 'EventController@addUser');
        Route::delete('/{id}/undo-user', 'EventController@undoUser');
    });

    // Shop
    Route::group(['prefix' => 'shop'], function() {
        Route::get('/categories', 'ProductCategoryController@categories');

        Route::get('/categories/{categoryId}/products', 'ProductController@categoryProducts')
            ->where('categoryId', '[0-9]+|all');

        Route::group(['prefix' => 'products'], function() {
            Route::get('{id}', 'ProductController@product');
            Route::get('/random', 'ProductController@getRandomProducts');
            Route::get('/popular', 'ProductController@getPopularProducts');
            Route::post('{id}/buy', 'ProductController@productBuy');
        });
    });

    // Stories
    Route::group(['prefix' => 'stories'], function() {
        Route::get('/', 'StoriesController@getStories');
    });
});

Route::group(['middleware' => [
    'auth', UserRole::middleware([UserRole::ADMIN, UserRole::MODERATOR])
]], function() {

    // Events
    Route::group(['prefix' => 'events'], function() {
        Route::post('/{id}/add-ball', 'EventController@addBalanceForEvent');
        Route::get('/active/{id}/user', 'EventController@getActiveEvents');
    });
});


// Auth
Route::group(['prefix' => 'user'], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/register-verify-code', 'AuthController@registerVerifyCode');
    Route::post('/reset-verify-code', 'UserController@passwordResetVerifyCode');
    Route::post('/password-reset', 'UserController@passwordReset');

    Route::post('/question', 'UserController@userQuestion');
});
