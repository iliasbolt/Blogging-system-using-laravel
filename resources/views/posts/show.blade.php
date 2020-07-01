	
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

								<p>
									<div id="{{$p->id}}">
									@if(Auth()->user()->id == $p->user->id)
										<button class="btn btn-sm bg-danger text-primary btnDelComment" id="{{$p->id}}">
											X
										</button>
									@endif
									 &nbsp &nbsp &nbsp{{$p->text}} &nbsp;  | &nbsp; {{$p->created_at}} posted by &nbsp;

									<a href="/profile/{{$p->user->id}}"><strong>{{$p->user->name}}</strong></a>
									</div>
								</p>

							</fieldset>
								<script>
									$(document).ready(function () {

										$.ajaxSetup({
											headers: {
												'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
											}
										});

										$(".btnDelComment").click(function (e) {

											let IDComment = e.target.id;
											//alert(IDComment);

											$.ajax(
													{url:"{{route('ajaxDelete')}}",Type:'POST' ,data:{idC:IDComment}
													, dataType:'JSON',success:function(result){
												console.log("success",result);
												let data = eval(result);
															 if(data.status == 1)
															 {

																 document.getElementById(IDComment).remove();
															 }
															 else{
															 	alert("Somthing went wrong Please try again !!");
															 }

											},error:function(result){

													//alert("");
											}
											})
										})




									});
								</script>

							@endforeach

						@else
							<br><br>
							<fieldset>

									<h5>No comments</h5>

							</fieldset>
						@endif
					</div>
			</div>	<br>
							<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">

								<form action="/putComment/{{$post->id}}" method="Post">
										{{csrf_field()}}
									<div class="form-group col-md-6 col-lg-8 col-xs-8 col-sm-8">
									 <input type="text" name="Comment" placeholder="PutComment" class="form-control "/>
									</div>
									<div class="form-group col-md-4 col-lg-4 col-xs-4 col-sm-4">
										<input type="submit" name="submit" value="submit" class="btn btn-primary"/>
									</div>

								</form>
							</div>
			<br>

	@if(!Auth::guest())

		@if(Auth::user()->id == $post->user_id)
			<div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
				<a href="/posts/{{$post->id}}/edit" class="btn btn-info btn-block"> Edit</a>
			</div>


		<!-- Delete part // b7ala b7al edit 7ta hiya khassa Delete method but we need use hidden trick--->
		<div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
			{!!Form::open(['action' => ['PostController@destroy',$post->id] , 'method' => 'Post','class' => '']) !!}
			{{Form::hidden('_method','DELETE')}}
			{{Form::submit('Delete',['class' => 'btn btn-danger btn-block'])}}

			{!!Form::close()!!}
		</div>
			@endif
	@endif

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<a href="/posts" class="btn btn-default btn-block"> Go Back </a>
	</div>

			<!-- git  tests to push -->
</div>
