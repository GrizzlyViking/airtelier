<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Address;
use App\Models\Offer;
use App\Models\OfferType;
use App\Models\User;
use http\Client\Response;
use App\Http\Requests\OfferRequest as Request;
use Exception;
use Illuminate\Support\Arr;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::with('address')->get();
        return view('offers.index')->with(compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = User::all();
        $types = OfferType::all()->map(function(OfferType $type){
            return [
                'id' => $type->id,
                'name' => ucwords($type->type),
            ];
        });
        return response()->view('offers.create', compact('options', 'types'));
    }

    /**
     * @param OfferRequest $request
     */
    public function store(OfferRequest $request)
    {
        $address = Address::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Offer  $offer
     * @return Response
     */
    public function edit(Offer $offer)
    {
        return view('offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Offer  $offer
     * @return Response
     */
    public function update(Request $request, Offer $offer)
    {
        $offer->address()->update(Arr::except($request->get('address'), ['country']));
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
