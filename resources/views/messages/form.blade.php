{!! csrf_field() !!}

@if ($showFields)
	<p>
		<label for="nombre">
			nombre
			<input type="text" class="form-control" name='nombre' value="{{$message->nombre or old('nombre') }}" autofocus>
			{!! $errors->first('nombre' , '<span class=error>:message</span>') !!}
		</label>
	</p>

	<p>
		<label for="email">
			Email
			<input type="text" class="form-control" name="email" value="{{$message->email or old('email') }}">
			{!! $errors->first('email' , '<span class=error>:message</span>') !!}
		</label>
	</p>
@endif

<p>
	<label for="mensaje">
		Mensaje
		<textarea name="mensaje" class="form-control">{{ $message->mensaje or old('mensaje') }}</textarea>
		{!! $errors->first('mensaje' , '<span class=error>:message</span>') !!}
	</label>
</p>

<input type="submit" class="btn btn-primary" value="{{ $btnText ?? 'Guardar' }}">