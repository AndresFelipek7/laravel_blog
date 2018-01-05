@extends('layout')

@section('title' , 'Menu Saludo')

@section('content')
	<h1>Saludos para {{ $nombre }}</h1>
	<ul>
		@forelse ($consolas as $consola)
			<li>
				{{ $consola }}
			</li>
		@empty
			{{ "No se ha encontrado la informacion" }}
		@endforelse
	</ul>
@endsection