<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	public function articles()
	{
		return $this->morphToMany(
			Article::class,
			'relation',
			'gallery'
		);
	}

	public function events()
	{
		return $this->morphToMany(
			Event::class,
			'relation',
			'gallery'
		);
	}

	public function resources()
	{
		return $this->morphToMany(
			Resource::class,
			'relation',
			'gallery'
		);
	}
}
