<?php

namespace App\Repositories;

use App\Message;

class Messages implements MessagesInterface
{
	public function getPaginated()
	{
		return Message::with(['user' , 'note' , 'tags'])
				->orderBy('created_at', request('sorted'))
				->Paginate(10);
	}

	public function store($request)
	{
		$message = Message::create($request->all());

		//Si esta autentificado haz esto
		if (auth()->check()) {
			//Con el metodo save asignamos el mensaje ya guardado a la relacion
			auth()->user()->messages()->save($message);
		}

		return $message;
	}

	public function findById($id)
	{
		return Message::findOrFail($id);
	}

	public function update($request,$id)
	{
		return Message::findOrFail($id)->update($request->all());
	}

	public function destroy($id)
	{
		return Message::findOrFail($id)->delete();
	}
}