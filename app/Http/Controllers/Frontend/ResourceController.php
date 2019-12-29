<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceType;

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
}
