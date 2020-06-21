<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;

class searchController extends Controller
{
    public function filter()
    {
        $text  = Input::get('search');
        if(empty($text) || is_null($text))
        {
            $posts = Post::orderBy('created_at','acs')->paginate(5);//paginate for pagination 1 in page hhh
            return redirect('/posts')->with('posts',$posts);
        }

        $posts = Post::where('title','like','%'.$text.'%')->get();
        return view('Pages.filter')->with('posts',$posts)->with('text',$text);
    }

    public function liveSearch(Request $request){

            if($request->isMethod('POST')){
                $txtT = $request->txtLive;

                $all = Post::where('title','like','%'.$txtT.'%')->get();

                $tt = array('msgBack'=> $all);

            }

            return response()->json($tt);

    }
}
