<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;

class PagesController extends Controller
{
	public function home()
	{
		return view('home');
	}

	public function mensaje(CreateMessageRequest $request)
	{
		return back()->with('info' , 'Tu mensaje ha sido enviado correctamente :)');
	}

	public function saludo($nombre = 'Invitado')
	{
		$html = "<h2> Hola soy un titulo con un h2 </h2>";
		$script = "<script> alert('Hola soy un virus malicioso'); </script>";
		$consolas = [
			'play' => 'play Station 4',
			'Xbox' => 'Xbox one x'
		];
		return view('saludo' , compact('nombre' , 'html' , 'script' , 'consolas'));
	}
}
