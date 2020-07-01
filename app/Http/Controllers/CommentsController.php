<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Exception;
use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{

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

    public function ajaxDelete(Request $request)
    {


            $comment = Comment::findOrFail($request->idC);

            try {
                $comment->delete();
                return response()->json(['status'=>1]);
            }catch(Exception $ex)
            {
                return response()->json(['status'=>0]);
            }


    }
    
}
