<?php

namespace App\Http\Controllers;

use App\Http\Requests\resourceRequest;
use App\Models\Address;
use App\Models\Resource;
use App\Models\ResourceType;
use \Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\resourceRequest as Request;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    private static $relationships = [
        'type' => [
            'relationship' => 'resourceType',
            'column' => 'type'
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $resources = Resource::with('address');
        if (count($query = request()->query()) > 0) {
            foreach ($query as $key => $value) {
                $resources->whereHas(Arr::get(self::$relationships,"$key.relationship"), function ($query) use ($key, $value) {
                    $query->where(Arr::get(self::$relationships,"$key.column"), 'like', $value);
                });
            }
        }
        $resources = $resources->get();

        if (request()->ajax()) {
            return response($resources);
        }

        return response()->view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $types = ResourceType::all()->map(function (ResourceType $type) {
            return [
                'id'   => $type->id,
                'name' => ucwords($type->type),
            ];
        });
        return response()->view('resources.create', compact('options', 'types'));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function store(resourceRequest $request)
    {
        /** @var Resource $resource */
        $resource = Resource::create($request->all());
        if ($request->has('address')) {
            /** @var Address $address */
            $address = Address::create($request->get('address'));
            $resource->addresses()->attach($address);
        }

        if ($request->ajax()) {
            return response($resource->toArray());
        }

        return response()->redirectToRoute('resources.index');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        if (request('resource_type') && ! ResourceType::where('type', request('resource_type'))->exists()) {
            throw new ModelNotFoundException('Resource type does not exist');
        }

        $resource = Resource::findOrFail(request('resource'));

        if (request('resource_type')) {
            return view('frontend.resources.show', compact('resource'));
        }
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Resource $resource
     *
     * @return ResponseFactory
     */
    public function edit(Resource $resource)
    {
        if (Auth::user()->can('update', $resource)) {

            return response()->view('resources.edit', compact('resource'));
        }

        return response()->redirectToRoute('resources.show', compact('resource'));
    }

    /**
     * @param Request  $request
     * @param Resource $resource
     *
     * @return ResponseFactory|Response
     * @throws AuthorizationException
     */
    public function update(Request $request, Resource $resource)
    {
        if ($request->ajax() && Auth::user()->cant('update', $resource)) {
            throw new AuthorizationException('You are not permitted to update this resource.');
        }

        $resource->address()->update($request->get('address'));
        $resource->update($request->except('address', 'owner', 'resource_type'));

        return response($resource->toArray());
    }

    /**
     * @param Resource $resource
     *
     * @return Response
     * @throws Exception
     */
    public function destroy(Resource $resource): Response
    {
        $resource->delete();
        return response('ok');
    }
}
