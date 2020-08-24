@extends('layout')

@section('title', 'Usuarios')

@section('content')
  <div class="d-flex justify-content-between align-items-end mb-3">
  <h1 class="pb-1">{{ $title }}</h1>
  <p>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario</a>
  </p>
  </div>
  @if ($users->isNotEmpty())
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Correo</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name}}</td>
        <td>{{ $user->email }}</td>
        <td>
	  <form action="{{ route('users.destroy', $user) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a href="{{ route('users.show', $user) }}" class="btn btn-link"><span class="oi oi-eye"></span></a>
            <a href="{{ route('users.edit', $user) }}" class="btn btn-link"><span class="oi oi-pencil"></span></a>
            <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
          </form>
        </td>
      </tr>    
      @endforeach
    </tbody>
  </table>
  @else
    <p>No hay usuarios registrados.</p>
  @endif


    <!--ul>
        @forelse ($users as $user)
            <li>
                {{ $user->name }}, ({{ $user->email }})
                <--*example*a href="{{ url("/usuarios/{$user->id}") }}">Ver detalles</a->
                <--*example*a href="{{ action('UserController@show', ['id' => $user->id]) }}">Ver detalles</a->
                <--*example*a href="{{ route('users.show', ['id' => $user->id]) }}">Ver detalles</a-> 
                <--*example*a href="{{ route('users.show', ['id' => $user]) }}">Ver detalles</a-> 
                <a href="{{ route('users.show', $user) }}">Ver detalles</a> |
                <--*example*a href="{{ route('users.edit', ['id' => $user->id]) }}">Editar</a->
                <--*example*a href="{{ route('users.edit', ['id' => $user]) }}">Editar</a->
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
    </ul-->
@endsection

@section('sidebar')
    @parent
@endsection


