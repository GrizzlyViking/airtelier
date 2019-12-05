<?php

namespace App\Models\_interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Interface ResourceInterface
 *
 * @package App\Models\_interfaces
 * @property Collection $addresses
 * @property Collection $reviews
 * @property Collection $gallery
 * @property Collection $prices
 * @property Collection $transactions
 */
interface ResourceInterface
{
	public function transactions(): Relation;

	public function gallery(): Relation;

	public function price(): Relation;

 	public function addresses(): Relation;

	public function reviews(): Relation;
}
