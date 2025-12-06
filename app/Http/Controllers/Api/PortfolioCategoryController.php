<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        return PortfolioCategory::orderBy('name')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:portfolio_categories,slug'],
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        return PortfolioCategory::create($data);
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:portfolio_categories,slug,'.$portfolioCategory->id],
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $portfolioCategory->update($data);

        return $portfolioCategory;
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->delete();

        return response()->noContent();
    }
}
