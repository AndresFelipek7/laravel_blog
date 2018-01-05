@extends('layout')

@section('content')
	<h1>Editar Usuario {{ $user->name }}</h1>

	@if (session()->has('info'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Bien!</strong> {{ session('info') }}
		</div>
	@endif

	<form action="{{ route('usuarios.update' , $user->id) }}" method="POST">
		{!! method_field('PUT') !!}

		@include('users.form')

		<input type="submit" class="btn btn-warning" value="Actualizar">
	</form>
@endsection