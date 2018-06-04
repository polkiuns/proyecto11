<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\Comment;
class CommentsController extends Controller
{
    public function create(Clase $clase , Request $request)
    {

        $request->validate([
            'body' => 'required|between:3,250',
        ]);
    	$comment = new Comment;
    	$comment->body = $request->body;
    	$comment->clase_id = $clase->id;
    	$comment->user_id = auth()->user()->id;
    	$comment->save();

    	return back()->with('flash' , 'Tu comentario se ha agregado satisfactoriamente');


    }
    public function edit(Comment $comment, Request $request)
    {
        $request->validate([
            'bodyEditar' => 'required|between:3,250',
        ]);
    	$comment->body = $request->bodyEditar;
    	$comment->save();

    	return back();
    }
    public function delete(Comment $comment)
    {
    	$comment->delete();
    	return back()->with('flash' , 'Tu comentario se ha agregado satisfactoriamente');
    }
}
