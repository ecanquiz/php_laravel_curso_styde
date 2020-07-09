@extends('layout')

@section('title', "Usuario {$user->name}")

@section('content')
    <h1>Usuario #{{ $user->id }}</h1>
    <p>Nombre del usuario: {{ $user->name }}</p>
    <p>Correo electrónico: {{ $user->email }}</p>
    <p>
        <!--a href="{{ url()->previous() }}">Regresar</a-->
        <!--a href="{{ url('/usuarios/') }}">Regresar al listado de usuarios</a-->
        <!--a href="{{ action('UserController@index') }}">Regresar al listado de usuarios</a-->
        <a href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
    </p>
@endsection
