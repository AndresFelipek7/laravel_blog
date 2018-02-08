<?php

namespace App\Presenters;

use App\Message;
use Illuminate\Support\HtmlString;

class MessagePresenter extends Presenter
{
	public function userName()
	{
		/*El objeto $this es el objeto del mensaje donde podemos llamar a un campo si existe*/
		if ($this->model->user_id) {
			return $this->userLink();
		}
		return $this->model->nombre;
	}

	public function userEmail()
	{
		if ($this->model->user_id) {
			return $this->model->user->email;
		}
		return $this->model->email;
	}

	public function link()
	{
		return new HtmlString("<a href='" . route('mensaje.show' , $this->model->id) . "'>{$this->model->mensaje }</a>");
	}

	public function userLink()
	{
		/*
			Con $this accedemos al objeto que se envio desde el modelo
			Con model llegamos al modelo Message que es donde estamos
			Accedemos a la relacion de message con user
			Dentro de user buscamos el metodo present
			y dentro del metodo present buscamos el metodo link
		*/
		return $this->model->user->present()->link();
	}

	public function notes()
	{
		return $this->model->note ? $this->model->note->body : 'No hay notas disponibles';
	}

	public function tags()
	{
		return $this->model->tags ? $this->model->tags->pluck('name')->implode(',') : 'No hay Etiquetas';
	}
}