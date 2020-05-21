<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" 
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Listado de usuarios - Style.net</title>

    </head>
    <body>
        <h1>{{ $title }}</h1>
        <hr/>

        <!--
        @if (!empty($users))
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user }}</li>      
                @endforeach
            </ul>
        @else
            <p>No hay usuarios registrados</p>
        @endif
        -->

        <!--
        @unless(empty($users))
            <ul>
                @foreach ($users as $user)
                    <li>{{ $user }}</li>      
                @endforeach
            </ul>
        @else
            <p>No hay usuarios registrados</p>
        @endunless
        -->


            <ul>
                @forelse ($users as $user)
                    <li>{{ $user }}</li>
                @empty
                   <li>No hay usuarios registrados</li>  
                @endforelse
            </ul>

            {{ time() }}

    </body>
</html>
