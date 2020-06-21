


<!-- header homie -->
@include('layouts.app')
@include('ics.messages')

<div class="container font_ok">
   <!-- <div class="list-group-item well">
        <form action="/filter" method="Post">
            {{csrf_field()}}
            <input type="text" class="form-control">
            <button class="btn btn-secondary my-2 my-sm-0" name="search" id="search" style="display: inline" type="submit">Searche</button>
        </form>
    </div>-->
    <h1>Result for : {{$text}}</h1>

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
                                    <h6> created at {{$post->created_at}} by {{$post->user['name']}} </h6>
                                    <hr>
                                    <p class="lead ">
                                        @if(strlen($post->body)  > 190)
                                            {{substr($post->body,0,190)}} ...
                                        @else
                                            {{$post->body}} ...
                                        @endif
                                    </p>
                        </div>

                    </div>


                </div>

        @endforeach


        </div>
    @else
        <h4>No empty data</h4>
    @endif

<br>

       <a href="/posts" class="btn btn-default btn-block">Go Back</a><br><br>
</div>