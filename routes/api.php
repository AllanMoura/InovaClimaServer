<?php

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/', 'HomeController@version')->name('api.index');
Route::get('/nicknames', "NicknameController@index")->name('nicknames.index');
Route::post('/nicknames', "NicknameController@register")->name('nicknames.register');
Route::post('/places', "PlaceController@createPlace")->name('places.create');
Route::get('/places', "PlaceController@index")->name('places.index');
Route::post('/places/search', "PlaceController@searchPlaces")->name('places.search');
Route::post('/favoritos', "FavoritoController@changeFavorito")->name('favoritos.change');
Route::get('/favoritos/{nicknameId}', "FavoritoController@getFavoritos")->name('favoritos.getFavoritos');
Route::post('/previsao', "PlaceController@editPrevisoes")->name('previsoes.edit');
Route::get('/places/{placeId}', "PlaceController@getPlace")->name('places.getPlace');
