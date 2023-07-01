<?php

namespace App\Http\Controllers;

use App\Models\review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        //


        $review = new Review();
        $review->rating = $request->input('rating');
        $review->message = $request->input('message');
        $review->subject = $request->input('subject');
        $review->user_id = Auth::user()->id;
        $review->product_id = $id;



        // $review->user()->associate(auth()->user()); // Assuming authenticated user
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(review $review)
    {
        //
    }
}
