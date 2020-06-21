<?php

namespace App\Http\Controllers;

use http\Cookie;
use http\Env\Response;
use Illuminate\Http\Request;
use App\User;
use App\Mail\Mymail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserProfile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only'=>'show','update']);

    }
    public function show(Request $request)
    {


        $myId = Auth()->user()->id;
        $user = User::find($myId);
        $meProfile = "meProfile";
        //return route('profile')->with('profile',$user)->withCookie(cookie('who','profile',10));
        return view('Pages.myProfile',compact('meProfile'))->with('profile',$user);
    }

    public function update(Request $request,$id)
    {
        //hna andi joj uses of this function one is update your pofile two is see others profile
        //bla mandir joj dial views ndir wa7da wa nb9a l3eb biha


        //hadi update your profile
        if($request->isMethod('POST'))
        {
            $this->validate($request,[
                'password' => 'required|min:8|max:30',
                'email' => 'required',
                'name' => 'required|min:8|max:30',
            ]);

            //hna kanakhod id men and user maid maghadix nkhdem bih for security reasons :)

            $myId = Auth()->user()->id;
            $user = User::find($myId);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->about = $request->input('aboutme');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect()->route('profile')->with('success','Profile Updated With Success');
        }
        else {//hadi bax txouf others Account
            $user = User::find($id);

            return view('Pages.myProfile')->with('profile',$user);
        }

    }

    public function sendMail(Request $request)
    {

        $email =  $request->input('email');
        if($request->input('email'))

          $newPassword = "P@assw0rdOk123";


         $target = User::where('email','like',$email)->first();
         $target->password = bcrypt($newPassword);
         $target->save();

         $request->session()->flash('status','Mail Sent with Success !!!! ');

         Mail::to($email)->send(new MyMail($newPassword));
         return redirect()->route('home')->with('success','Email Sent Successfully');
    }

}
