<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Nickname;
use App\Log;

class NicknameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nicknames = Nickname::all();
        return response()-> json(compact('nicknames', 200));
    }

    public function register(Request $request){
        
        $this->validate($request, [
            'nickname' => 'required|string|max:20',
        ]);
        $input = $request->input();
        $nickname = Nickname::firstOrNew(['nickname' => $input['nickname']]);
        if($nickname->id == null){
            $nickname = new Nickname();
            $nickname->nickname =  $input['nickname'];
            $nickname->hash = $this->makeHash('nicknames');
        }else{
            $log = new Log();
            $log->acao = 'Logar';
            $log->descricao = 'nickname: '.$nickname->nickname.' Logou';
            $log->nicknameId = $nickname->id;
            $log->save();
            return response()->json(compact('nickname'));
        }
        
        if($nickname->save()){
            $log = new Log();
            $log->acao = 'Registrar';
            $log->descricao = 'nickname: '.$nickname->nickname.' registrado';
            $log->nicknameId = $nickname->id;
            $log->save();
            return response()->json(compact('nickname'));
        }else{
            return response()->json(['error' => 'Problema ao salvar nickname', 'status' => '500'], 500);
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function makeHash($table)
    {
        $result = null;
        while(true){
            $hash = strtolower(str_random(20));
            $count = DB::table($table)->select()->where('hash', $hash)->count();
            if($count == 0){
                $result = $hash;
                break;
            }
        }
        return $result;
    }
}
