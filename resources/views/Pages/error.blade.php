@include('layouts.app')
    <div class="container">
        @if(is_null($ok) || empty($ok) )
            <h1 style="margin: auto"> 404 Not Found Page </h1>
            @else
                @if(count($ok) > 0)
                    <h1 style="margin: auto"> {{$ok}} </h1>
                    @else
                    <h1 style="margin: auto"> 404 Not Found Page </h1>

                    @endif
            @endif
            <br>
            <a href="/posts" class="btn btn-default btn-block">Go Back</a><br><br>
    </div>
