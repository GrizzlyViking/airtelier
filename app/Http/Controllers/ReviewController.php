<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Review;
use App\Http\Requests\ReviewRequest as Request;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $reviews = Review::all();
        return response()->view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $review = Review::create($request->validated());

        if ($request->ajax()) {
            return response($review);
        }

        return response($review)->view('review.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Review  $review
     * @return Response
     */
    public function show(Review $review)
    {
        $review = $review->load('reviewed');
        return response()->view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Review  $review
     * @return Response
     */
    public function edit(Review $review)
    {
        $review = $review->load('reviewed');
        return response()->view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Review  $review
     * @return Response
     */
    public function update(Request $request, Review $review)
    {
        $review->update($request->validated());

        if ($request->ajax()) {
            return response($review);
        }

        return response($review)->redirectToRoute('reviews.show', $review->id);
    }

    /**
     * @param Review $review
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response()->redirectToRoute('reviews.list');
    }
}
