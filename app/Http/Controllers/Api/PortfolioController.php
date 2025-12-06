<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Portfolio::query()->orderByDesc('created_at');

        if ($category = $request->query('category')) {
            $query->where('category', $category);
        }

        $portfolios = $query->paginate(6);

        return PortfolioResource::collection($portfolios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortfolioRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['project_name']);

        $portfolio = Portfolio::create($data);

        return new PortfolioResource($portfolio);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        return new PortfolioResource($portfolio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['project_name']);

        $portfolio->update($data);

        return new PortfolioResource($portfolio);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return response()->noContent();
    }
}
