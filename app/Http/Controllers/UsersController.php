<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
	function __construct()
	{
		/*Se llama al middleware auth para evitar que ingresen a modulos sin autentificarse*/
		$this->middleware('auth' , ['except' => ['show']]);
		$this->middleware('roles:admin' , ['except' => ['edit', 'update' , 'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::with(['roles' , 'note' , 'tags'])->get();
		return view('users.index' , compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$roles = Role::pluck('display_name','id');

		return view('users.create' , compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\CreateUserRequest;
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateUserRequest $request)
	{
		$user = User::create($request->all());

		$user->roles()->attach($request->roles);

		return redirect()->route('usuarios.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return view('users.show' , compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);

		$this->authorize('edit',$user);

		//Con el metodo pluck lo que hacemos es traer toda la informacion del modelo. como primer parametro recibe el valor de la llave y el segundo parametro es la llave en si que se envia a la vista
		//Pluck es un metodo que nos permite crear un array dependiendo de los parametros que se coloque
		$roles = Role::pluck('display_name','id');

		return view('users.edit' , compact('user','roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateUserRequest $request, $id)
	{
		$user = User::findOrFail($id);

		$this->authorize('update',$user);

		$user->update($request->only('name','email'));

		//Al objeto user llamamos a la relacion roles() y con el metodo attach enlazamos los roles que nos llega por medio del request al objeto user para la actualizacion
		//$user->roles()->attach($request->roles);
		//El metodo sync es muy parecido al metodo attach pero con la diferencia que en este caso no nos va ha duplicar la informacion del mismo registro en una actualizacion
		$user->roles()->sync($request->roles);

		return back()->with('info' , 'Usuario Actualizado');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$user = User::findOrFail($id);

		$this->authorize('destroy' , $user);

		$user->delete();

		return back();
	}
}
