<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;
use Exception;
use phpDocumentor\Reflection\Types\This;

class PostController extends Controller
{

     public function __construct()
    {

        $this->middleware('auth',['except' => ['index','show']]);
        
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //ila khassek tkhdem old school wa tkte query jib libairie DB 3mel >> use DB;
    //DB::select('SELECT * FROM posts');

    //orderby $posts = POST::orderBy('title','desc')->get();/get daori 7itax ghatjib data
    public function index()
    {
        /*
        return Post::all();
        return view('posts.index');*/

        // ila bghina result f variable wa nsaredoha l view
        //$posts = Post::all();
        $posts = Post::orderBy('created_at','acs')->withCount('comments')->paginate(5);//paginate for pagination 1 in page hhh
        return view('posts.index')->with('posts',$posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
                
        ]);
        ///image processing

            if($request->hasFile('cover_image')){//ila kayna image f request
                //getFilename with extention
                $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
                //get just file name
        $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);

                //get just extension
            $extentin = $request->file('cover_image')->getClientOriginalExtension();

            $filnameToStore = $filename.''.time().'.'.$extentin;

            //uploading process
            $path = $request->file('cover_image')->storeAs('public/cover_images',$filnameToStore);

            //db howa ghay7etom f storage/app/public  hadi may9derx browser ywsela :(
            //------walakin 7na khasni ynezlom f public l3adia 
            //so khassni ncreeyiw simulation ya3nio f7al trigger ila nzlet xi 7aja f storage/app/public ymxi ynezla f public l3adia :)

            //---silution howa //
            //terminal and type:
                //simlink smiyto
            //php artisan storage:link
                ////!!!!!!!! -------- db hada li t7atet l storage dial resource ghadi t7et f public storage -------///
            //that's it :) niiiiiiiiiiiiiiiice
            //hada howa storage li ghaykono fih tsawar 
                


            }
            else{
                $filnameToStore = "noimage.jpg";
            }

        //create post 
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $filnameToStore;
        try{

            $s = auth()->user()->id;
            //$v = auth()->user()->name;

            //return $v;
            
        }catch(Exception $ex){
            $s=0;
        }
       
        $post->user_id = $s; //hna ghanjio id dial user li dakhel db (current user)
        $post->save();

        return redirect('/posts')->with('success','Post Created with success :)');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //proffetional method is in

        try {
            $post = (new \App\Post)->findOrFail($id);
        }catch(Exception $ex){
            return view('Pages.error')->with('ok','Post Not Found ');
        }

            return view('posts.show')->with('post',$post);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $post = (new \App\Post)->findOrFail($id);
        }catch (Exception $ex)
        {
            return view('Pages.error')->with('ok','Post Not Found');
        }
            //check for correct user id
            if(auth()->user()->id !== $post->user_id)
            {
                return redirect('/posts')->with('error','Unauthorized Page');
            }
            $ediTP = "ediT";
            return view('posts.edit',compact('ediTP','id'))->with('post',$post);


        
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
         $this->validate($request,[
            'title' => 'required',
            'body' => 'required'

        ]);
          ///image processing

            if($request->hasFile('cover_image')){//ila kayna image f request
                //getFilename with extention
                $filenamewithExt = $request->file('cover_image')->getClientOriginalName();
                //get just file name
        $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                    
                //get just extension
            $extentin = $request->file('cover_image')->getClientOriginalExtension();

            $filnameToStore = $filename.''.time().'.'.$extentin;

            //uploading process
            $path = $request->file('cover_image')->storeAs('public/cover_images',$filnameToStore);

            //db howa ghay7etom f storage/app/public  hadi may9derx browser ywsela :(
            //------walakin 7na khasni ynezlom f public l3adia 
            //so khassni ncreeyiw simulation ya3nio f7al trigger ila nzlet xi 7aja f storage/app/public ymxi ynezla f public l3adia :)

            //---silution howa //
            //terminal and type:
            //php artisan storage:link
            //that's it :) niiiiiiiiiiiiiiiice
            //hada howa storage li ghaykono fih tsawar 
            }
           
        //hna makhasna x ncreyiw post jdid 7itax hadi update deja kayn wa7ed
        $post= Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if($request->hasFile('cover_image')){
            $post->cover_image = $filnameToStore ;
        }

        $post->save();

        return redirect('/posts')->with('success','Post Updated with success !!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post= (new \App\Post)->findOrFail($id);

        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('errors','Unauthorized Page'); 
        }
        $post->delete();

        if($post->cover_image != 'noimage.jpg'){
            //delete from storage
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        return redirect('/posts')->with('success','Post Deleted Successfully :)');
    }
}
