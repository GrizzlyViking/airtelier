<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Interface ResourceInterface
 *
 * @package App\Interfaces
 * @property Collection $addresses
 * @property Collection $reviews
 * @property Collection $gallery
 * @property Collection $prices
 * @property Collection $transactions
 */
interface Resource
{
	public function gallery(): Relation;

 	public function addresses(): Relation;

	public function reviews(): Relation;
}
