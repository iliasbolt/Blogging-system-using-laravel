	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


            <!-- header homie -->
            @include('layouts.app')
<div class="container">
		<h1>Create post</h1>

		@include('ics.messages')

  {!! Form::open(['action' => 'PostController@store' , 'method' => 'Post' ,'enctype'=> 'multipart/form-data']) !!}
    <div class="form-group">
    	{{Form::label('title','Title')}}
    	{{Form::text('title','',['class' => 'form-control','placeholder' => 'title text'])}}
    </div>
     <div class="form-group">
    	{{Form::label('body','Body')}}
    	{{Form::textarea('body','',['class' => 'form-control','placeholder' => 'Body text'])}}
    </div>
    <div class="form-group">
      {{Form::file('cover_image')}}
    </div>

    	

    {{Form::submit('submit',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}


</div>  