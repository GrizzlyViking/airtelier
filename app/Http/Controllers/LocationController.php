<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|View
     */
    public function index()
    {
        $locations = Location::all()->columns(['owner.name', 'name', 'description', 'address']);

        if (request()->ajax()) {
            return response()->json($locations,200,[],JSON_UNESCAPED_UNICODE);
        }

        /** @var Location $location */
        $columns = array_keys(Arr::except($locations->first(), ['id', 'deleted_at', 'created_at', 'updated_at', 'meta']));

        return view('locations.index', compact('locations', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $options = User::all();
        return response()->view('locations.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     * @param LocationRequest $request
     * @return Response|RedirectResponse
     */
    public function store(LocationRequest $request)
    {
        Location::create($request->toArray());

        if (request()->ajax()) {
            return response()->json('success', Response::HTTP_CREATED);
        }

        return response()->redirectToRoute('locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Location  $location
     * @return Response
     */
    public function show(Location $location): Response
    {
        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Location  $location
     * @return Response
     */
    public function edit(Location $location): Response
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LocationRequest $request
     * @param Location  $location
     * @return Response
     */
    public function update(LocationRequest $request, Location $location): Response
    {
        $location->fill($request->toArray());
        $location->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Location $location
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Location $location): RedirectResponse
    {
        $location->delete();

        return redirect()->route('locations.index');
    }
}
