<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorito;
use App\Log;
use App\Nickname;

class FavoritoController extends Controller
{
    public function getFavoritos($nicknameId){
        $nickname = Nickname::find($nicknameId);
        if(!$nickname){
            return response()->json(['error' => 'nicknameId not Found'], 404);
        }
        $favoritos = $nickname->favoritos()->get();
        return response()->json(compact('favoritos'));
    }
    
    public function changeFavorito(Request $request)
    {
        $input = $request->input();
        if(!isset($input['nicknameId'])){
            return response()->json(['error' => 'Bad Request - nicknameId is missing'], 400);
        }
        if(!isset($input['placeId'])){
            return response()->json(['error' => 'Bad Request - placeId is missing'], 400);
        }
        $favorito = Favorito::where('nicknameId', $input['nicknameId'])->where('placeId', $input['placeId'])->first();
        if(!$favorito){
            $favorito = new Favorito();
            $favorito->nicknameId = $input['nicknameId'];
            $favorito->placeId = $input['placeId'];
            if($favorito->save()){
                return response()->json(compact('favorito'));
            }else{
                return response()->json(['error' => 'Problema ao salvar favorito'], 500);
            }
        }else{
            $favorito->delete();
            return response()->json(['message' => 'favorito deletado com sucesso'], 200);
        }
    }
}
