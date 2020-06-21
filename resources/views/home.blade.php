@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif



                    <h3>{{__('text.yourblogs')}}</h3>
                    
                    <a href="/posts/create" class="btn btn-primary">{{__('text.create')}}</a><hr>
                    @if(count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-lg">{{__('text.edit')}}</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['PostController@destroy',$post->id] , 'method' => 'Post','class' => 'pull-right']) !!}

                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit(__('text.delete'),['class' => 'btn btn-danger btn-lg'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>

                            @endforeach
                        </tr>


                    </table>
                    <br><br><br>
                    @else
                        <h5>You Dont Have Not Posts Yet</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
