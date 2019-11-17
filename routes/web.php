<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// frontend
Route::name('frontend.')->group(function () {
    Route::get('/article/{article}',['uses' => 'Frontend\ArticleController@show','as' => 'offer.show']);
    Route::get('/{offer_type}/{offer}',['uses' => 'OfferController@show','as' => 'offer.show']);
	Route::get('/event', ['uses' => 'Frontend\EventController@index', 'as' => 'event.list']);
	Route::get('/{offer_type}', ['uses' =>  'Frontend\OfferController@index', 'as' => 'offer.list']);

    Route::get('/', ['uses' => 'PagesController@landing', 'as' => 'landing_page']);
    Route::get('/register', ['uses' => 'PagesController@register', 'as' => 'register']);
});

Route::redirect('/offers', '/admin/offers');
Route::redirect('/articles', '/admin/articles');
Route::redirect('/reviews', '/admin/reviews');
Route::redirect('/events', '/admin/events');
Route::redirect('/users', '/admin/users');

Route::prefix('admin')->group(function () {
    Auth::routes();
    Route::middleware('auth')->group(function () {
        Route::resource('articles', 'ArticleController');
        Route::resource('messages', 'MessageController');
        Route::resource('reviews', 'ReviewController');

        Route::resource('events', 'EventController');
        Route::resource('offers', 'OfferController');
        Route::resource('users', 'UserController');

        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('oauth2', ['uses' => 'Auth\OauthController@setUpClient', 'as' => 'oauth2']);

        Route::post('images', [
            'uses' => 'ImageController@upload',
            'as'   => 'image.upload'
        ]);
    });
});
