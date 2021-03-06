<?php

use App\Models\Countries;
use App\Models\OfferType;
use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->get('/users', function () {
    return User::all();
});

Route::middleware('auth:api')->get('/countries', function () {
    return Countries::all();
});

Route::middleware('auth:api')->get('/types', function () {
    return OfferType::all();
});
