<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OfferType;
use Illuminate\Http\Request;

class OfferController extends Controller
{
	public function index(OfferType $offer_type)
	{
		$offers = $offer_type->offers;
		return view('frontend.offers.list', compact('offers'));
    }
}
