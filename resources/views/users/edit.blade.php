@extends('layout')

@section('title', "Editar usuario")

@section('content')
    <h1>Editar usuario</h1>

    <!--?php dd($errors); ?-->

    @if ($errors->any())
    <div class="alert alert-danger">
        <h5>Por favor corrige los siguientes errore(s)</h5>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!--form method="POST" action="{{ url('usuarios/crear') }}"-->
    <form method="POST" action="{{ url('usuarios') }}">
        <!--{!! csrf_field() !!}-->
        {{ csrf_field() }}
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $user->name) }}">
        <br>
        <label for="email">Correo eletrónico:</label>
        <input type="email" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email', $user->email) }}">
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Mayor a 6 caracteres">
        <button type="submit">Actualizar usuario</button>
    </form>
    
    <p>
        <a href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
    </p>
@endsection
