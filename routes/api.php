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

Route::get('/', 'HomeController@version')->name('api.index'); // versão
Route::get('/atlgo', 'HomeController@getAtlGo')->name('api.atlGo'); // versão
Route::get('/atlmg', 'HomeController@getAtlMg')->name('api.atlMg'); // versão
Route::get('/botafogo', 'HomeController@getBotaFogo')->name('api.botafogo'); // versão
Route::get('/bahia', 'HomeController@getBahia')->name('api.bahia'); // versão

Route::get('/nicknames', "NicknameController@index")->name('nicknames.index'); //Lista de todos os usuarios
Route::post('/nicknames', "NicknameController@register")->name('nicknames.register'); //Login/registra, se existir, loga, se não, registra. atributos :> nickname: string
Route::post('/places', "PlaceController@createPlace")->name('places.create');//Cria um novo place - elemento :> cidade: string, bairro: string
Route::get('/places', "PlaceController@index")->name('places.index'); //busca todas as places do banco
Route::post('/places/search', "PlaceController@searchPlaces")->name('places.search'); //busca places que contenham as palavras do elemento query. elementos:> query: string, nicknameId: integer
Route::post('/favoritos', "FavoritoController@changeFavorito")->name('favoritos.change');//Toggle de favoritos, se estiver como favorito, remove, retorna um  objeto "message", se não, adiciona como favoritos. elementos:> nicknameId: integer, placeId: integer.
Route::get('/favoritos/{nicknameId}', "FavoritoController@getFavoritos")->name('favoritos.getFavoritos');// funcao get que recebe um nicknameId e retorna a lista de places favoritos do usuario
Route::post('/previsao', "PlaceController@editPrevisoes")->name('previsoes.edit'); // recebe uma lista de previsoes e atualiza no servidor, retorna a mesma lista de previsoes
Route::get('/places/{placeId}', "PlaceController@getPlace")->name('places.getPlace');// retorna um place, recebe um placeId como parametro
Route::post('/usuarios', "UsuarioController@createOrLogin")->name('usuarios.createOrLogin');
Route::get('/usuarios', "UsuarioController@index")->name('usuarios.index');