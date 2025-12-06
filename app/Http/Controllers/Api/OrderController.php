<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['client', 'service'])
            ->when($request->payment_status, fn ($q) => $q->where('payment_status', $request->payment_status))
            ->when($request->order_status, fn ($q) => $q->where('order_status', $request->order_status))
            ->when($request->search, function ($q) use ($request) {
                $q->where('order_number', 'like', "%{$request->search}%")
                    ->orWhereHas('client', fn ($qc) => $qc->where('name', 'like', "%{$request->search}%"));
            })
            ->orderByDesc('created_at');

        $orders = $query->paginate(15);
        return OrderResource::collection($orders);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_number' => ['nullable', 'string', 'max:255', 'unique:orders,order_number'],
            'client_id' => ['nullable', 'exists:users,id'],
            'lead_id' => ['nullable', 'exists:leads,id'],
            'service_id' => ['required', 'exists:services,id'],
            'custom_requirements' => ['nullable', 'string'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'final_price' => ['required', 'numeric', 'min:0'],
            'payment_status' => ['required', 'in:pending,waiting_payment,partially_paid,paid,refunded'],
            'order_status' => ['required', 'in:new,confirmed,in_progress,completed,cancelled'],
            'due_date' => ['nullable', 'date'],
            'notes_internal' => ['nullable', 'string'],
        ]);

        $data['order_number'] = $data['order_number'] ?? 'ORD-' . now()->format('YmdHis');

        $order = Order::create($data);

        return new OrderResource($order->load(['client', 'service']));
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load(['client', 'service', 'payments', 'project']));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'order_number' => ['nullable', 'string', 'max:255', 'unique:orders,order_number,' . $order->id],
            'client_id' => ['nullable', 'exists:users,id'],
            'lead_id' => ['nullable', 'exists:leads,id'],
            'service_id' => ['required', 'exists:services,id'],
            'custom_requirements' => ['nullable', 'string'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'final_price' => ['required', 'numeric', 'min:0'],
            'payment_status' => ['required', 'in:pending,waiting_payment,partially_paid,paid,refunded'],
            'order_status' => ['required', 'in:new,confirmed,in_progress,completed,cancelled'],
            'due_date' => ['nullable', 'date'],
            'notes_internal' => ['nullable', 'string'],
        ]);
        $data['order_number'] = $data['order_number'] ?? $order->order_number;
        $order->update($data);

        return new OrderResource($order->fresh()->load(['client', 'service', 'payments']));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}
