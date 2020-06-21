	
	

            <!-- header homie -->
            @include('layouts.app')
            @include('ics.messages')
            
	<div class="container font_ok">
		<div class="list-group-item well">
			<form action="/filter" method="Post" id="searchForm">
				{{csrf_field()}}

				<input type="text" class="form-control" name="search" id="search">

				<input class="btn btn-secondary mb-2 btn-lg btnrecherch"  style="display: inline" type="submit" value="{{__('text.search')}}"/>
			</form>

			<div class="searchHelper list-group">

			</div>
			<script>
				
				$(document).ready(function(){
					//ajax setup 
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
						}
					});

					//operation start
					$("#search").keyup(function(){
						var text = document.getElementById("search").value;
						
						if(text === "")
						{
							$(".searchHelper").html("");
						}
						else{//if input is not empty then i send him to server

								$.ajax({url:"{{route('liveSearch')}}",type:'POST',
								data:{txtLive:text},dataType:'JSON',success:function(result){
										var ok = result.msgBack;
										var nice = eval(ok);//darori khassni eval !!!!!!!!!!!!!!1!!!!!!!!!!!!
										var one ="";
											for(var i=0;i < nice.length;i++)
											{
												var oneItem = nice[i];
												one += '<div class="oneItemsearch list-group-item" id="'+oneItem.id+'" onclick="placeText(this.id);">&nbsp&nbsp'+oneItem.title+'</div>'
											}
										$(".searchHelper").html(one);
										//$("#search").css("color","Darkgray");
									},error:function() {
										alert('Somthing Went Wrong try later !!');
									}
								 });
						}

					});

				});
				//click on title
				function placeText(cc)
				{
					var i = $("#"+cc+"").text();
					var t = i.trimStart();
					document.getElementById("search").value = t;
					document.getElementById("searchForm").submit();
				}
			</script>
		</div>

		<h1>{{__('text.Posts')}}</h1>

		@if(count($posts)  > 0)
			
				<div class="d-inline-flex p-2">
			
				@foreach($posts as $post)
					<div class="well">
						<div class="row">
							<div class="col-md-4 col-sn-4">
								<img src="/storage/cover_images/{{$post->cover_image}}" style="width: 100%;height: 250px;">
							</div>
							<div class="col-md-8 col-sn-8">
								 <h2><a href="/posts/{{$post->id}}">{{$post->title}}</a><h2>
						<h6> {{__('text.created_at')}} {{$post->created_at}} by <strong><a href="/profile/{{$post->user_id}}">{{$post->user['name']}}</a></strong>  </h6>
										 <hr>
										 <p class="lead ">
											 @if(strlen($post->body)  > 190)
													 {{substr($post->body,0,190)}} ...
												 @else
												 	{{$post->body}} ...
											 @endif
										 </p>
										 <div class="badge badge-pill"> {{__('text.comments')}} {{$post->comments_count}}</div>
							</div>
							
						</div>
						

					</div>

					@endforeach

				<h4 style="text-align: center;"> {{$posts->links()}} </h4> <!-- Pagination  khassek tzid paginate f controller dialek -->
				</div>
		@else
			<h4>No empty data</h4>
		@endif


</div>