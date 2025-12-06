<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
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
            'client_name' => $this->client_name,
            'company' => $this->company,
            'position' => $this->position,
            'content' => $this->content,
            'rating' => $this->rating,
            'photo_url' => $this->photo_url,
            'is_featured' => $this->is_featured,
        ];
    }
}
