@extends('layout')

@section('title' , 'Menu de Inicio')

@section('content')
	<h1>Todos los Mensajes</h1>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Mensaje</th>
				<th>Notas</th>
				<th>Etiquetas</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($messages as $message)
				<tr>
					<td>{{ $message->id }}</td>

					@if ($message->user_id)
						<td>
							<a href="{{ route('usuarios.show' , $message->user_id) }}">
								{{ $message->user->name }}
							</a>
						</td>
						<td>{{ $message->user->email }}</td>
					@else
						<td> {{ $message->nombre }} </td>
						<td> {{ $message->email }} </td>
					@endif

					<td>
						<a href="{{ route('mensaje.show' , $message->id) }}">
							{{ $message->mensaje }}
						</a>
					</td>

					<td>{{ $message->note ? $message->note->body : 'No hay Notas' }}</td>

					<td>{{ $message->tags ? $message->tags->pluck('name')->implode(',') : 'No hay Etiquetas' }}</td>

					<td>
						<a href="{{ route('mensaje.edit' , $message->id) }}" class="btn btn-info">Editar</a>
						<form style="display:inline;" action="{{ route('mensaje.destroy' , $message->id) }}" method="POST">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}

							<button class="btn btn-danger">Eliminar</button>
						</form>
					</td>
				</tr>
			@endforeach
			{!! $messages->appends(request()->query())->links() !!}
		</tbody>
	</table>
@endsection