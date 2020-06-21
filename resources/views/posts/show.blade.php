	
            <!-- header homie -->
            @include('layouts.app')
			@include('ics.messages')
		
		

		<div class="container">
		<h2 style="margin-left: 10%;">{{$post->title}}</h2>
			<img src="/storage/cover_images/{{$post->cover_image}}" style="width: 80%;height: 450px;margin: auto;margin-left: 10%;border-radius: 10px;">
								<br><br>
			<div style="margin-left: 10%;">
				<h3> created at {{$post->created_at}} by <a href="/profile/{{$post->user->id}}">{{$post->user->name}}</a></h3>
				<h4> body {{$post->body}}</h4>
				<h6> updated at {{$post->created_at}}</h6>
					<div class="container">
						@if(count($post->comments) > 0)
							<br><br>
							<h3>Comments</h3>
						
							@foreach($post->comments as $p)
							<fieldset>
								<p> Comment :{{$p->text}} &nbsp;  | &nbsp; {{$p->created_at}} posted by &nbsp;
									<a href="/profile/{{$p->user->id}}"><strong>{{$p->user->name}}</strong></a>

								</p>
							</fieldset>

							@endforeach

						@else
							<br><br>
							<fieldset>

									<h5>No comments</h5>

							</fieldset>
						@endif
					</div>
			</div>	<br>
							<div>

								<form action="/putComment/{{$post->id}}" method="Post">
										{{csrf_field()}}

									<input type="text" name="Comment" placeholder="PutComment" class="form-control"/>
									<input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
								</form>
							</div>
	<hr>
	@if(!Auth::guest())

		@if(Auth::user()->id == $post->user_id)
		<a href="/posts/{{$post->id}}/edit" class="btn btn-info btn-block"> Edit</a>
		<br>

		<!-- Delete part // b7ala b7al edit 7ta hiya khassa Delete method but we need use hidden trick--->

		{!!Form::open(['action' => ['PostController@destroy',$post->id] , 'method' => 'Post','class' => '']) !!}
		{{Form::hidden('_method','DELETE')}}
		{{Form::submit('Delete',['class' => 'btn btn-danger btn-block'])}}

		{!!Form::close()!!}
			@endif
	@endif

	<br>
			<a href="/posts" class="btn btn-default btn-block">Go Back</a><br><br>
</div>
