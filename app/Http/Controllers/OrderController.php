<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'shippingMethod', 'payment']);
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,cancelled',
            'shipping_status' => 'required|in:proses,dikirim,selesai,dibatalkan',
        ]);

        $order->payment_status = $request->payment_status;
        $order->shipping_status = $request->shipping_status;
        $order->save();

        return redirect()->route('orders.show', $order)->with('success', 'Order status updated successfully');
    }
}
