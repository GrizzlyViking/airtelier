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
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	return view('mango.index');
});

Route::get('/calendar', function() {
	return view('frontend.calendar');
});

Route::get('schedule/{resource}/calendar',
	['uses' => 'ScheduleController@calendar','as' => 'resource.calendar']
);
Route::put('schedule/{id}/request',
	['uses' => 'ScheduleController@request','as' => 'schedule.request']
);

Route::name('frontend.')->prefix('old')->group(function () {
	Route::get('/account', ['uses' => 'UserController@show', 'as' => 'account.show'])->middleware('auth');
	Route::put('/account', ['uses' => 'UserController@update', 'as' => 'account.update']);

	Route::get('/cart/basket', ['uses' => 'CartController@get', 'as' => 'cart.get']);
	Route::post('/cart/add', ['uses' => 'CartController@add', 'as' => 'cart.add']);
	Route::get('checkout', ['uses' => 'CartController@checkout', 'as' => 'cart.checkout']);
	Route::get('payment', ['uses' => 'CartController@payment', 'as' => 'cart.payment']);

	Route::get('/article/{article}', ['uses' => 'Frontend\ArticleController@show', 'as' => 'resource.show']);
	Route::get('/events', ['uses' => 'Frontend\EventController@index', 'as' => 'event.list']);

	Route::get('/', ['uses' => 'PagesController@landing', 'as' => 'landing_page']);

	Route::get('/register', ['uses' => 'PagesController@register', 'as' => 'register']);

	Route::get('/{resource_type}/{resource}',
		['uses' => 'Frontend\ResourceController@show','as' => 'resource.show']
	)->where('resource_type', implode('|', config('airtelier.resource_types')));

	Route::get('/{resource_type}',
		['uses' => 'Frontend\ResourceController@index','as' => 'resource.list']
	)->where('resource_type', implode('|', config('airtelier.resource_types')));
});

Auth::routes();

Route::prefix('admin')->group(function () {
	Route::middleware('auth')->group(function () {
		Route::resource('articles', 'ArticleController');
		Route::resource('messages', 'MessageController');
		Route::resource('reviews', 'ReviewController');

		Route::resource('events', 'EventController');
		Route::resource('resources', 'ResourceController');
		Route::resource('users', 'UserController');

		Route::get('/home', 'HomeController@index')->name('home');

		Route::get('oauth2', ['uses' => 'Auth\OauthController@setUpClient', 'as' => 'oauth2']);

		Route::post('images', [
			'uses' => 'ImageController@upload',
			'as'   => 'image.upload'
		]);
	});
});
