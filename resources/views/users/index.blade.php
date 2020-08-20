@extends('layout')

@section('title', 'Usuarios')


@section('content')
    <h1>{{ $title }}</h1>

    <p>
        <a href="{{ route('users.create') }}">Nuevo usuario</a>
    </p>

    <ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}, ({{ $user->email }})
                <!--a href="{{ url("/usuarios/{$user->id}") }}">Ver detalles</a-->
                <!--a href="{{ action('UserController@show', ['id' => $user->id]) }}">Ver detalles</a-->
                <!--a href="{{ route('users.show', ['id' => $user->id]) }}">Ver detalles</a--> 
                <!--a href="{{ route('users.show', ['id' => $user]) }}">Ver detalles</a--> 
                <a href="{{ route('users.show', $user) }}">Ver detalles</a> |
                <!--a href="{{ route('users.edit', ['id' => $user->id]) }}">Editar</a-->
                <!--a href="{{ route('users.edit', ['id' => $user]) }}">Editar</a-->
                <a href="{{ route('users.edit', $user) }}">Editar</a> |
		<form action="{{ route('users.destroy', $user) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @empty
            <li>No hay usuarios registrados.</li>  
        @endforelse
    </ul>
@endsection

@section('sidebar')
    @parent
@endsection


