	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
            <!-- header homie -->
            @include('layouts.app')
	<div class="container">
		<h1>{{__('text.editP')}}</h1>

		@include('ics.messages')

{!! Form::open(['action' => ['PostController@update',$post->id] , 'method' => 'Post','enctype' => 'multipart/form-data' ]) !!}<!--       hna f update khassna n3adlo put walakin maymkenx so khass n3adlo hidden wa nbedlo post b put  --> 
    <div class="form-group">
    	{{Form::label('title',__('text.titleP'))}}

    	{{Form::text('title',$post->title,['class' => 'form-control','placeholder' => 'title text'])}}
      
    </div>
     <div class="form-group">
    	{{Form::label('body',__('text.bodyP'))}}
    	{{Form::textarea('body',$post->body,['class' => 'form-control','placeholder' => 'Body text'])}}
    </div>
    <div class="form-group">
      {{Form::file('cover_image')}}
    </div>
    	{{Form::hidden('_method','PUT')}} <!-- Hna kan9olo bdel post b put method hhhh -->

    {{Form::submit('submit',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}

</div>
