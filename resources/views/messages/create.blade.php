@extends('layout')

@section('title' , 'Menu de Contacto')

@section('content')
	<h1>Contactos</h1>
	<h2>Escribeme</h2>
	@if (session()->has('info'))
		<h3>{{ session('info') }}</h3>
	@else
		<form action="{{ route('mensaje.store') }}" method="POST">
			@include('messages.form',[
				'message' => new App\Message,
				'showFields' =>auth()->guest()
			])
		</form>
	@endif
@endsection