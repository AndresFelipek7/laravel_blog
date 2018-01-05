@extends('layout')

@section('content')
	<h1>Lista de Usuarios</h1>
	<a class="btn btn-primary pull-right" href="{{ route('usuarios.create') }}">Crear nuevo usuario</a>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>rol</th>
				<th>Notas</th>
				<th>Etiquetas</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>
						{{ $user->name }}
					</td>
					<td>{{ $user->email }}</td>
					<td>
						{{-- {{ $user->roles->pluck('display_name')->implode(' - ') }} --}}
						@foreach ($user->roles->pluck('display_name') as $nameRol)
							@switch($nameRol)
								@case("Administrador del sitio")
									<span class="label label-success"> {{ $nameRol }} </span>
								@break

								@case("Estudiante")
									<span class="label label-danger"> {{ $nameRol }} </span>
								@break

								@case("Moderador de comentarios")
									<span class="label label-info"> {{ $nameRol }} </span>
								@break

								@default
									<span>Rol Desconocido</span>
							@endswitch
						@endforeach
					</td>
					<td>{{ $user->note ? $user->note->body : '' }}</td>
					<td>{{ $user->tags->pluck('name')->implode(',') }}</td>
					<td>
						<a class="btn btn-info"
							href="{{ route('usuarios.edit' , $user->id) }}">Editar</a>
						<form style="display:inline;"
							 action="{{ route('usuarios.destroy' , $user->id) }}"
							 method="POST">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}

							<button class="btn btn-danger">Eliminar</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection