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

					<td>{{  $message->present()->userName() }}</td>

					<td>{{ $message->present()->userEmail() }}</td>

					<td>{{ $message->present()->link() }}</td>

					<td>{{ $message->present()->notes() }}</td>

					<td>{{ $message->Present()->tags() }}</td>

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