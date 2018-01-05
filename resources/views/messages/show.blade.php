@extends('layout')

@section('content')
	<h1>El contenido del mensaje es</h1>

	<p>Enviado por {{ $message->nombre }} - {{ $message->email }}</p>
	<p>{{ $message->mensaje }}</p>
	<a href="{{ route('mensaje.index') }}">volver al Listado</a>
	<hr>
@endsection