<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Models\Resource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|JsonResponse
     */
    public function index()
    {
        $resources = Resource::all();
        if (request()->ajax()) {
            return response()->json($resources, 200, [], JSON_UNESCAPED_UNICODE);
        }

        return view('resource', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('resource.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ResourceRequest  $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(ResourceRequest $request)
    {
        /** @var Resource $resource */
        $resource = Resource::create($request);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $resource->toArray()
            ]);
        }

        return redirect()->route('resource.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Resource  $resource
     * @return View
     */
    public function show(Resource $resource)
    {
        return view('resource.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Resource  $resource
     * @return View
     */
    public function edit(Resource $resource)
    {
        return view('resource.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ResourceRequest  $request
     * @param  Resource  $resource
     * @return RedirectResponse|JsonResponse
     */
    public function update(ResourceRequest $request, Resource $resource)
    {
        $resource->fill($request->toArray());
        $resource->save();
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $resource->toArray()
            ]);
        }

        return redirect()->route('resource.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resource $resource
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();

        return redirect()->route('resource.index');
    }
}
