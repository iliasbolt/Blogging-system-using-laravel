@include('layouts.app')
@include('ics.messages')

@if(empty($profile) || is_null($profile))
    <div class="container">
        <h3> User Not Found !! </h3>
    </div>
    @else
 <div class="container">
  <form action="/profile/{{$profile->id}}" method="POST" id="formProfile">
      <input type="hidden" name="_token" value="{{csrf_token()}}"/>
   <div class="form-row">

      <div class="form-group col-md-6">
          <label for="name">{{__('text.username')}}: </label>
       <input type="text" class="form-control" value="{{session('error') ? Request::old('name') : $profile->name }}" name="name" id="name" required/>
      </div>

    <div class="form-group col-md-6">
        <label for="email">{{__('text.email')}}: </label>
     <input type="email" class="form-control" value="{{session('error') ? Request::old('email') : $profile->email }}" name="email" id="email" required/>
    </div>
       @if(!Auth::guest())

           @if(Auth::user()->id == $profile->id)
       <div class="form-group col-md-12">
           <label for="email">{{__('text.password')}}: </label>
           <input type="password" class="form-control" value="{{Request::old('password')}}" required name="password" id="password" placeholder="Put New Password !"/>
       </div>
       <div class="form-group col-md-12">
           <label for="email">{{__('text.confirmpassword')}}: </label>
           <input type="password" class="form-control" required placeholder="Confirm the New Password !" name="Confirmpassword" id="Confirmpassword" placeholder="Put New Password !"/>
       </div>
           @endif
       @endif
       <div class="form-group col-md-12">
           <label for="email">{{__('text.aboutMe')}} </label>
           <textarea type="text" class="form-control col-4"  name="aboutme" id="aboutme" > {{session('error') ? Input::old('aboutme') : $profile->about }} </textarea>
       </div>
       @if(!Auth::guest())
           @if(Auth::user()->id == $profile->id)
               <div class="form-group col-md-6">
                   <button class="btn btn-success btn-block" name="submit_btn" id="submit_btn" type="button">{{__('text.submit')}}</button>
               </div>
               <div class="form-group col-md-6">
                   <button class="btn btn-info btn-block" id="update" type="button">{{__('text.update')}}</button>
               </div>
               @endif
       @endif
   </div>
  </form>


 </div>
<div class="container">
    <a id="goback" class="btn btn-block btn-default" href="/">{{__('text.goback')}}</a>
</div>


<script >
    $(document).ready(function () {
        //open buttons
        InputsMN(true);

        //some tricks
        function InputsMN(cc)
        {
            document.getElementById("aboutme").disabled = cc;
            document.getElementById("name").disabled = cc;
            document.getElementById("password").disabled = cc;
            document.getElementById("email").disabled = cc;
            document.getElementById("submit_btn").disabled = cc;
            document.getElementById("Confirmpassword").disabled = cc;
        }

        //disabling inputs homie



        $("#update").click(function(){
            InputsMN(false);
        });


        $("#submit_btn").click(function(){
            var pass1 = document.getElementById("password").value ;
            var pass2 = document.getElementById("Confirmpassword").value ;

            //return pass1 == pass2 ? true : else;
            //chek if password equal then send data to server
            if(pass1 == pass2)
            {
                //niice now data verified but we ned verify data in server side too ;
                document.getElementById("formProfile").submit();
            }
            else{
                //alert('Passwords Not matching');
                $("#Confirmpassword").css('border','1px solid red');
            }
        });


    });
</script>

    @endif