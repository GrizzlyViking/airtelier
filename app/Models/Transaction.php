<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $guarded = [
		'id'
	];

	protected $hidden = [
		'created_at',
		'updated_at',
	];

	public function transactionable()
	{
		return $this->morphTo();
	}
}
