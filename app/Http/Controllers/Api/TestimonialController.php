<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Cache::remember('testimonials.public', 300, function () {
            return Testimonial::orderByDesc('is_featured')
                ->orderByDesc('created_at')
                ->get();
        });

        return TestimonialResource::collection($testimonials);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        $testimonial = Testimonial::create($request->validated());
        Cache::forget('testimonials.public');

        return new TestimonialResource($testimonial);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return new TestimonialResource($testimonial);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request, string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($request->validated());
        Cache::forget('testimonials.public');

        return new TestimonialResource($testimonial);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        Cache::forget('testimonials.public');

        return response()->noContent();
    }
}
