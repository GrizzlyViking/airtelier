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

Route::get('/', function() {
    return response()->redirectToRoute('home');
});

Route::resource('events', 'EventController');
Route::resource('offers', 'OfferController');

Route::resource('articles', 'ArticleController');
Route::resource('messages', 'MessageController');
Route::resource('reviews', 'ReviewController');

Route::post('images', [
    'uses' => 'ImageController@upload',
    'as' => 'image.upload'
]);

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


