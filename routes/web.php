<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/',function(){
	return '<h1>hello World from laravel</h1>';
});
*/


//------- Method 1 3ayet l view direct ----------//

					/*Route::get('/About',function(){
						return view('Pages.about');
					});*/

//------- Method 2 3ayet l view Men Controller ----------//and this is the right way

//use Illuminate\Routing\Route;
//use Illuminate\Support\Facades\Route as FacadesRoute;

use App\Post;
use App\User;

Route::get('/About','PagesControler@about');
Route::get('/Services','PagesControler@services');
					


/*
Route::get('/Services',function(){
	return view('Pages.services');
});
/*
Route::get('/Users/{id}/{name}',function($id,$name){//this is how to put variable dinamicly in page hhhhhh 
	return 'This is the id you get > '.$id.' and the name of '.$name;
});
*/
///////niiiiiiiiiiiice ////---------------- ymken tmxi l view direct or create controller and from controller go to view and this is the right way :);;

////now call a controller 

Route::get('/','HomeController@index'); // nice db kan3ayto l method from controller wa khass controler y3ayet l view

Route::resource('posts','PostController');//hna kayw9e3 dikxi li makayenx f route links :)CRud Operations

Route::post('/putComment/{id}','CommentsController@store')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//search part
Route::post('/filter','searchController@filter');






//live search
Route::get('ajaxRequest','searchController@liveSearch');
Route::post('ajaxRequest','searchController@liveSearch')->name('liveSearch');





//profile
Route::get('/profile',['uses'=>'UserProfile@show','as'=>'profile']);//named profile
Route::post('/profile/{id}','UserProfile@update')->name('updateProfile');
Route::get('/profile/{id}','UserProfile@update');

//send mail
Route::Post('/sendMail',['uses' => 'UserProfile@sendMail','as'=>'sendMail']);

//translate and language  dik ? ya3ni not required

Route::get('posts/lang/{lg?}',function ($lg = null){
    \Illuminate\Support\Facades\App::setlocale($lg);
        $posts = Post::orderBy('created_at','acs')->withCount('comments')->paginate(5);//paginate for pagination 1 in page hhh

        return view('posts.index')->with('posts',$posts);

});

Route::get('profile/lang/{lg?}',function ($lg = null){
    \Illuminate\Support\Facades\App::setlocale($lg);
    //$posts = Post::orderBy('created_at','acs')->withCount('comments')->paginate(5);//paginate for pagination 1 in page hhh
    $myId = Auth()->user()->id;

    $user = User::find($myId);
    $meProfile = "meProfile";
    return view('Pages.myProfile',compact('meProfile'))->with('profile',$user);


});

//your posts
Route::get('/lang/{lg?}',function ($lg = null){
    \Illuminate\Support\Facades\App::setlocale($lg);
    $user_id = auth()->user()->id;
    $user  = User::findOrFail($user_id);
    $me = "me";
    return view('home',compact('me'))->with('posts',$user->posts);
});
//edit post

Route::get('/posts/{id}/edit/lang/{lg?}',function ($id,$lg = null){
    \Illuminate\Support\Facades\App::setlocale($lg);
    try{

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
    $ediT = "ediT";
    return view('posts.edit',compact('ediT','id'))->with('post',$post);

});
