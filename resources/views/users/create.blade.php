@extends('layout')

@section('title', "Crear usuario")

@section('content')
<div class="card">

  <h4 class="card-header">Crear usuario</h4>

  <div class="card-body">

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

      <div class="form-group">
        <label for="name">Nombre:</label>
        <input class="form-control" type="text" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name') }}">
        {{--@if ($errors->has('name'))--}}
            {{--<p>{{ $errors->first('name') }}</p>--}}
        {{--@endif--}}
      </div>

      <div class="form-group">
        <label for="email">Correo eletrónico:</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="pedro@example.com" value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Mayor a 6 caracteres">
      </div>

      <button class="btn btn-primary" type="submit">Crear usuario</button>
      <a class="btn btn-link" href="{{ route('users.index') }}">Regresar al listado de usuarios</a>

    </form>
  </div>
</div>
@endsection
