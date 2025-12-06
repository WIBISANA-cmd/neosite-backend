<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_name' => $this->project_name,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => $this->category,
            'industry' => $this->industry,
            'demo_url' => $this->demo_url,
            'image_url' => $this->image_url,
            'tech_stack' => $this->tech_stack,
            'is_featured' => $this->is_featured,
            'created_at' => $this->created_at,
        ];
    }
}
