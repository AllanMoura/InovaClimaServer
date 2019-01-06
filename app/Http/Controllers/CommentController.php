<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return response()->json(compact('comments'));
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
        $input = $request->input();
        if (!isset($input['placeId'])) {
            return response()->json(['error' => 'Bad Request - placeId is missing'], 400);
        } else if (!isset($input['nicknameId'])) {
            return response()->json(['error' => 'Bad Request - nicknameId is missing'], 400);
        } else if(!isset($input['comment'])) {
            return response()->json(['error' => 'Bad Request - comment is missing'], 400);
        }
        $comment = new Comment();
        $comment->nicknameId = $input['nicknameId'];
        $comment->placeId = $input['placeId'];
        $comment->comment = $input['comment'];
        if ($comment->save()) {
            return response()->json($comment);
        } else {
            return response()->json(['error' => 'Server error - cannot save new comment.'], 500);
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
}
