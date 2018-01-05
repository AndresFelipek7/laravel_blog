<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use App\Message;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Events\MessageWasReceived;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CreateMessageRequest;
use App\User;

class MessagesController extends Controller
{

	//Esto es un constructor donde dentro podemos colocar lo que va ha afectar a todos los metodos por defecto a no ser que nosotros le dijamos que no lo haga
	function __construct()
	{
		//Estamos llamado a un middleware para evitar que por medio de la url sin autentificarse puedan acceder a un menu que solo esta visible cuando inicia sesion , ademas le pasamos como segundo arametro un arreglo que puede ser en espe caso que es except lo que significca que el valor que le colocamos es otro arreglo colcoando los nombre de los metodos que queremos que no mire el middleware
		$this->middleware('auth' , ['except' => ['create' , 'store']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//Sacamos todo la informacion de la tabla
		$messages = Message::with(['user' , 'note' , 'tags'])->get();

		//Redirecionamos
		return view('messages.index' , compact('messages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//Redirecionamos
		return view('messages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//Guardamos el mensaje con el metodo create
		$message = Message::create($request->all());

		//Si esta autentificado haz esto
		if (auth()->check()) {
			//Con el metodo save asignamos el mensaje ya guardado a la relacion
			auth()->user()->messages()->save($request->all());
		}

		//Llamamos al evento que envia el correo
		event(new MessageWasReceived($message));

		//Redireccionamos
		return redirect()->route('mensaje.create')->with('info' , 'Hola '.$request->nombre.' hemos recibido tu mensaje Exitosamente.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$message = Message::findOrFail($id);

		//Redireccionamos
		return view('messages.show' , compact('message'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$message = Message::findOrFail($id);

		//Redirecciomaos
		return view('messages.edit' , compact('message'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		Message::findOrFail($id)->update($request->all());

		//Redireccionamos

		return redirect()->route('mensaje.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Message::findOrFail($id)->delete();

		//Redireccionamos

		return redirect()->route('mensaje.index');

	}
}
