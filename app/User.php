<?php

namespace App;

use App\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Message;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = bcrypt($password);
	}

	//Hacemos la relacion de usuarios con los roles
	public function roles()
	{
		return $this->belongsToMany(Role::class , 'assigned_roles');
	}

	public function hasRoles(array $roles)
	{
		/*Explicacion de esta linea
			1)$this hace referencia a este archivo es decir a este modelo user
			2)roles hace referencia al metodo roles que esta en la parte superior de este
			3)metodo pluck de las colecciones nos permite generar un arreglo de solo nombres
			4)metodo intersect nos permite buscar entre dos arreglos que le pasamos comoparametro
			5)metodo count nos permite devolver 0 sino encuentra nada o mayr o igual a 1 si encontro algo*/
		return $this->roles->pluck('name')->intersect($roles)->count();
	}

	public function isAdmin()
	{
		return $this->hasRoles(['admin']);
	}

	public function messages()
	{
		return $this->hasMany(Message::class);
	}

	public function note()
	{
		return $this->morphOne(Note::class , 'notable');
	}

	public function tags()
	{
		return $this->morphToMany(Tag::class , 'taggable')->withTimestamps();
	}

	public function present()
	{
		return new UserPresenter($this);
	}
}
