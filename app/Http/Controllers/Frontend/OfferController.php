<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\OfferType;

class OfferController extends Controller
{
	public function index(OfferType $offer_type)
	{
		$items = $offer_type->offers()->with('gallery')->get();
		return view('frontend.offers.list', compact('items'));
    }

	public function show($offer_type, Offer $offer)
	{
		$offer->load('gallery');
		return view('frontend.offers.show', compact('offer'));
    }
}
