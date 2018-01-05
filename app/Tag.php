<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name'];

	public function message()
	{
		return $this->morphedByMany(Message::class, 'taggable');
	}

	public function users()
	{
		return $this->morphedByMany(User::class, 'taggable');
	}

}
