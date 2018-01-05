<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/css/app.css">
	<title>@yield('title')</title>
</head>
<body>
	{{-- <h1>{{ request()->url() }}</h1> --}}
	{{-- <h1>{{ request()->is('/') ? 'Estas en el Home' : 'No estas en el Home' }}</h1> --}}
	<?php
		function activeMenu($url){
			return request()->is($url) ? 'active' : '';
		}
	?>

	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ route('home') }}">Practicas Udemy</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav">

					<li class="{{ activeMenu('/') }}">
						<a href="{{ route('home') }}">Inicio</a>
					</li>
					<li class="{{ activeMenu('message/create') }}">
						<a href="{{ route('mensaje.create') }}">contactos</a>
					</li>

					{{-- Si hay un usuario autenticado es true --}}
					@if (auth()->check())

						<li class="{{ activeMenu('saludo*') }}">
							<a href="{{ route('saludo' , auth()->user()->name ) }}">Saludo</a>
						</li>

						<li class="{{ activeMenu('message*') }}">
							<a href="{{ route('mensaje.index') }}">mensajes</a>
						</li>

						@if (auth()->user()->hasRoles(['admin' , 'estudiante']))
							<li class="{{ activeMenu('usuarios*') }}">
								<a href="{{ route('usuarios.index') }}">Usuarios</a>
							</li>
						@endif
					@endif
				</ul>


				<ul class="nav navbar-nav navbar-right">
					{{-- Si hay una persona invitada es decir que no autentificado devuelve verdadero --}}
					@if (auth()->guest())
						<li class="{{ activeMenu('login') }}">
							<a href="/login">Login</a>
						</li>
					@else
						<li><a href="/logout">Cerrar Sesion</a></li>
						<li><a href="/usuarios/{{ auth()->id() }}/edit">Mi Cuenta</a></li>
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->name }} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="/logout">Cerrar Sesion</a></li>
								<li><a href="/usuarios/{{ auth()->id() }}/edit">Mi Cuenta</a></li>
							</ul>
						</li>
					@endif


				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<div class="container">
		@yield('content')
		<footer>
			copyright ©{{ date('Y') }}
		</footer>
	</div>

	<script src="/js/all.js"></script>
</body>
</html>