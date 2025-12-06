<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'client' => new UserResource($this->whenLoaded('client')),
            'lead_id' => $this->lead_id,
            'service' => new ServiceResource($this->whenLoaded('service')),
            'custom_requirements' => $this->custom_requirements,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
            'final_price' => $this->final_price,
            'payment_status' => $this->payment_status,
            'order_status' => $this->order_status,
            'due_date' => $this->due_date,
            'notes_internal' => $this->notes_internal,
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'project' => new ProjectResource($this->whenLoaded('project')),
            'created_at' => $this->created_at,
        ];
    }
}
