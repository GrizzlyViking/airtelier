<?php

namespace App\Http\Controllers\Frontend;

use App\Console\Commands\Resource\RequestEvent;
use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceType;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
	public function index(ResourceType $resource_type)
	{
		$items = $resource_type->resources()->with('gallery')->get();
		return view('frontend.resources.list', compact('items'));
    }

	public function show($resource_type, Resource $resource)
	{
		$resource->load('gallery');
		return view('frontend.resources.show', compact('resource'));
    }

	public function calendar(Resource $resource)
	{
		return view('frontend.calendar', compact('resource'));
    }
}
