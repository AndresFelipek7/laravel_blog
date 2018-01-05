@extends('layout')

@section('content')
	<h1>Crear nuevo usuario</h1>
	<form action="{{ route('usuarios.store') }}" method="POST">

		{{-- En este caso le pasamos al include como segundo parametro una nueva instancia del modelo user vacia porque cuando se crea un nuevo usuario no tiene un rol hasta que se cree miestras en una actualizacion si que tenemos un rol antiguo por modificar --}}
		@include('users.form', ['user' => new App\User])

		<input type="submit" class="btn btn-warning" value="Guardar">
	</form>
@endsection