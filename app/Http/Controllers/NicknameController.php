<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Nickname;

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

        if(Nickname::where('nickname', '=', $input['nickname'])->exists()){
            return response()->json(['error' => 'nickname ja utilizado, por favor, crie outro'], 409);
        }

        $newNickname = new Nickname();
        $newNickname->nickname = $input['nickname'];
        
        if($newNickname->save()){
            return response()->json(compact('newNickname'));
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
}
