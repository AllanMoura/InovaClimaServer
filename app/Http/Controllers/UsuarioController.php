<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json(compact('usuarios'));
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
    public function createOrLogin(Request $request)
    {
        $input = $request->input();
        if(!isset($input['nickname'])){
            return response()->json(['error' => 'Bad Request - nickname missing'], 400);
        }
        
        $u = Usuario::where('nickname', $input['nickname'])->first();
        if($u){
            return response()->json($u);
            #return response()->json(['error' => 'Bad Request - nickname already exists.'], 400);
        }

        $u = new Usuario();
        $u->nickname = $input['nickname'];
        $u->hash = $this->makeHash('usuarios');
        if($u->save()){
            return response()->json($u);
        }else{
            return response()->json(['error' => 'Server error - cannot save new user.'], 500);
        }


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
