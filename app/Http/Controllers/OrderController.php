<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'product'])->paginate(10);

            // Menyertakan total_price dari Order untuk setiap item
        foreach ($orderItems as $orderItem) {
            $orderItem->order->total_price = $orderItem->order->total_price;
        }

        return view('orders.index', compact('orderItems'));
    }
}
