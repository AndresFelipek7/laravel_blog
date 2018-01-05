{!! csrf_field() !!}
<p>
	<label for="nombre">
		nombre
		<input type="text" class="form-control" name='name' value="{{ $user->name or old('name') }}">
		{!! $errors->first('name' , '<span class=error>:message</span>') !!}
	</label>
</p>

<p>
	<label for="email">
		Email
		<input type="text" class="form-control" name="email" value="{{ $user->email or old('email') }}">
		{!! $errors->first('email' , '<span class=error>:message</span>') !!}
	</label>
</p>

{{-- A menos que el usuario tenga un id va ha mostrar los campos , sino tiene un id significa que se esta creadno uno nuevo y por eso no tiene --}}
@unless ($user->id)
	<p>
		<label for="password">
			password
			<input type="password" class="form-control" name='password'>
			{!! $errors->first('password' , '<span class=error>:message</span>') !!}
		</label>
	</p>

	<p>
		<label for="password_confirmation">
			Confirmar Contraseña
			<input type="password" class="form-control" name='password_confirmation'>
			{!! $errors->first('password_confirmation' , '<span class=error>:message</span>') !!}
		</label>
	</p>
@endunless

<div class="checkbox">
	@foreach ($roles as $id => $name)
	<label>
		<input
		type="checkbox"
		value="{{ $id }}"
		{{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}
		name="roles[]">
		{{ $name }}
	</label>
	@endforeach
	<br>
	{!! $errors->first('roles' , '<span class=error>:message</span>') !!}
	<hr>
</div>