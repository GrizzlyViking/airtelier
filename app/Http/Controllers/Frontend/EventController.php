<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
	public function index()
	{
		$items = Event::relevant()->with('gallery')->orderByDesc('start')->get();
		return view('frontend.offers.list', compact('items'));
    }
}
