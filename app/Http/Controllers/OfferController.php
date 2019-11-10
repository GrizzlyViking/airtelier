<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Address;
use App\Models\Offer;
use App\Models\OfferType;
use \Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\OfferRequest as Request;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    private static $relationships = [
        'type' => [
            'relationship' => 'offerType',
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
        $offers = Offer::with('address');
        if (count($query = request()->query()) > 0) {
            foreach ($query as $key => $value) {
                $offers->whereHas(Arr::get(self::$relationships,"$key.relationship"), function ($query) use ($key, $value) {
                    $query->where(Arr::get(self::$relationships,"$key.column"), 'like', $value);
                });
            }
        }
        $offers = $offers->get();

        if (request()->ajax()) {
            return response($offers);
        }

        return response()->view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $types = OfferType::all()->map(function (OfferType $type) {
            return [
                'id'   => $type->id,
                'name' => ucwords($type->type),
            ];
        });
        return response()->view('offers.create', compact('options', 'types'));
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function store(OfferRequest $request)
    {
        /** @var Offer $offer */
        $offer = Offer::create($request->all());
        if ($request->has('address')) {
            /** @var Address $address */
            $address = Address::create($request->get('address'));
            $offer->addresses()->attach($address);
        }

        if ($request->ajax()) {
            return response($offer->toArray());
        }

        return response()->redirectToRoute('offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        if (request('offer_type') && ! OfferType::where('type', request('offer_type'))->exists()) {
            throw new ModelNotFoundException('Offer type does not exist');
        }

        $offer = Offer::findOrFail(request('offer'));

        if (request('offer_type')) {
            return view('frontend.offers.show', compact('offer'));
        }
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Offer $offer
     *
     * @return ResponseFactory
     */
    public function edit(Offer $offer)
    {
        if (Auth::user()->can('update', $offer)) {

            return response()->view('offers.edit', compact('offer'));
        }

        return response()->redirectToRoute('offers.show', compact('offer'));
    }

    /**
     * @param Request $request
     * @param Offer   $offer
     *
     * @return ResponseFactory|Response
     * @throws AuthorizationException
     */
    public function update(Request $request, Offer $offer)
    {
        if ($request->ajax() && Auth::user()->cant('update', $offer)) {
            throw new AuthorizationException('You are not permitted to update this offer.');
        }

        $offer->address()->update($request->get('address'));
        $offer->update($request->except('address', 'owner', 'offer_type'));

        return response($offer->toArray());
    }

    /**
     * @param Offer $offer
     *
     * @return Response
     * @throws Exception
     */
    public function destroy(Offer $offer): Response
    {
        $offer->delete();
        return response('ok');
    }
}
