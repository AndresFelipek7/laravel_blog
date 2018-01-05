@extends('layout')

@section('content')
	<h1>Login</h1>
	<br>
		<form class="form-inline" action="/login" method="POST">
			{!! csrf_field() !!}
			<input type="email" class="form-control" name="email" placeholder="email" autofocus>
			<input type="password" class="form-control" name="password" placeholder="password">
			<input type="submit" class="btn btn-primary" value="Entrar">
		</form>
	</br>
@endsection