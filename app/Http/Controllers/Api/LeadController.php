<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Models\Order;
use App\Models\Service;
use App\Http\Resources\LeadResource;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leads = Lead::query()
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate(12);

        return LeadResource::collection($leads);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $request->user()?->isAdmin() ? ($data['status'] ?? 'baru') : 'baru';

        $lead = Lead::create($data);

        return new LeadResource($lead);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lead = Lead::findOrFail($id);

        return new LeadResource($lead);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeadRequest $request, string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update($request->validated());

        return new LeadResource($lead);
    }

    public function convertToOrder(string $id)
    {
        $lead = Lead::findOrFail($id);
        $service = Service::first();
        $order = Order::create([
            'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . $lead->id,
            'lead_id' => $lead->id,
            'service_id' => $service?->id ?? Service::first()->id,
            'custom_requirements' => $lead->message,
            'total_price' => 0,
            'discount' => 0,
            'final_price' => 0,
            'payment_status' => 'pending',
            'order_status' => 'new',
        ]);

        return response()->json(['order_id' => $order->id, 'order_number' => $order->order_number]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return response()->noContent();
    }
}
