<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $this->validate($request,[
            'Comment'=>'required|max:100'
        ]);

        $comment  = new Comment();
        $comment->text = $request->input('Comment');

        $comment->user_id = auth()->user()->id;
        $comment->post_id = $id;
        $comment->save();
        

        return redirect('/posts/'.$id);
    }
    
}
