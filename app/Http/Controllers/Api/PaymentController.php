<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string', 'max:255'],
            'payment_date' => ['nullable', 'date'],
            'proof_url' => ['nullable', 'url'],
            'status' => ['nullable', 'string', 'max:255'],
        ]);

        $payment = $order->payments()->create($data);
        return new PaymentResource($payment);
    }

    public function update(Request $request, Order $order, Payment $payment)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string', 'max:255'],
            'payment_date' => ['nullable', 'date'],
            'proof_url' => ['nullable', 'url'],
            'status' => ['nullable', 'string', 'max:255'],
        ]);
        $payment->update($data);

        return new PaymentResource($payment);
    }

    public function destroy(Order $order, Payment $payment)
    {
        $payment->delete();
        return response()->noContent();
    }
}
