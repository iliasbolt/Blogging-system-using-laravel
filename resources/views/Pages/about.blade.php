<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name','LSAPP')}}</title><!--hna ghan3ayto l title men .env file  wa kan9olo ila makan walo f app.name 3mel Tba3 LSAPP F3iwta-->


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>


            <!-- header homie -->
            @include('layouts.app')
<div class="container">
            
        <h1>About page</h1>
        <p>First test ever in Laravel So this is i'm gonna sure to have fun :)</p>
        <ul class="list-group">
                <li class="list-group-item">Services</li>
                <li class="list-group-item">About</li>
                <li class="list-group-item">index</li>

        </ul>
    </body>
    
</html>

</div>