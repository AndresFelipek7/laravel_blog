<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\MessagePresenter;

class Message extends Model
{
	protected $fillable = ['nombre' , 'email' , 'mensaje'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function note()
	{
		return $this->morphOne(Note::class , 'notable');
	}

	public function tags()
	{
		return $this->morphToMany(Tag::class , 'taggable');
	}

	public function present()
	{
		/*Se crea una nueva instancia de la clase MessagePresenter Para poder acceder a los metodos de la misma, ademas le estamos enviando el objeto $this que es el mensaje a la clase para que puede acceder dentro de ella.*/
		return new MessagePresenter($this);
	}
}
