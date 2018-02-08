@extends('layout')

@section('content')
	<h1>El contenido del mensaje es</h1>

	<p>Enviado por {{ $message->present()->userName() }} - {{ $message->present()->userEmail() }}</p>
	<p>{{ $message->mensaje }}</p>
	<a href="{{ route('mensaje.index') }}">volver al Listado</a>
	<hr>
@endsection