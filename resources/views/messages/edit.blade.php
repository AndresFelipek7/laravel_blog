@extends('layout')

@section('content')
	<h1>Editar el mensaje de {{ $message->nombre }}</h1>
	<form action="{{ route('mensaje.update' , $message->id) }}" method="POST">
		{!! method_field('PUT') !!}
		@include('messages.form',[
			'btnText' => 'Actualizar',
			'showFields' => ! $message->user_id
		])
	</form>
@endsection