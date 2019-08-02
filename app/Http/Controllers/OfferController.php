<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Address;
use App\Models\Offer;
use App\Models\OfferType;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\OfferRequest as Request;
use Exception;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $offers = Offer::with('address')->get();
        return view('offers.index')->with(compact('offers'));
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
        if ($request->has('address')) {
            /** @var Address $address */
            $address = Address::create($request->get('address'));
            $request->merge(['address_id' => $address->id]);
        }
        /** @var Offer $offer */
        $offer = Offer::create($request->all());

        if ($request->ajax()) {
            return response($offer->toArray());
        }

        return response()->redirectToRoute('offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     *
     * @return Response
     */
    public function show(Offer $offer)
    {
        $offer->address->load('country');
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Offer $offer
     *
     * @return Response
     */
    public function edit(Offer $offer): Response
    {
        return response()->view('offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Offer   $offer
     *
     * @return Response
     */
    public function update(Request $request, Offer $offer)
    {
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
