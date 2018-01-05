<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mensaje Recibido</title>
</head>
<body>
	<h1>Te responderemos a la brevedad potible , Correo para Avisar el propietario del sitio que se ha recibido un mensaje</h1>
	<p>
		Nombre: {{ $msg->nombre }} <br>
		Email: {{ $msg->email }} <br>
		Mensaje: {{ $msg->mensaje }}
	</p>
</body>
</html>