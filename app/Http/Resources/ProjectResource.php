<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class ProjectResource extends JsonResource
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
            'client' => new UserResource($this->whenLoaded('client')),
            'status' => $this->status,
            'progress_percent' => $this->progress_percent,
            'deadline' => $this->deadline,
        ];
    }
}
