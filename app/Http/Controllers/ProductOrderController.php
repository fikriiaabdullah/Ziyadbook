<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductOrderController extends Controller
{
    /**
     * Display the catalog of products
     */
    public function index()
    {
        $products = Product::with('category')->where('stock', '>', 0)->latest()->paginate(12);
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Filter products by category
     */
    public function byCategory($categoryId)
    {
        $products = Product::with('category')
            ->where('category_id', $categoryId)
            ->where('stock', '>', 0)
            ->latest()
            ->paginate(12);
        $categories = Category::all();
        $currentCategory = Category::findOrFail($categoryId);

        return view('shop.index', compact('products', 'categories', 'currentCategory'));
    }

    /**
     * Display the product details with checkout form
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();
        $shippingMethods = ShippingMethod::all();

        return view('shop.show', compact('product', 'relatedProducts', 'shippingMethods'));
    }

    /**
     * Store the order directly from product page
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the product
        $product = Product::findOrFail($request->product_id);
        $shippingMethod = ShippingMethod::findOrFail($request->shipping_method_id);

        // Check stock availability again
        if ($product->stock < $request->quantity) {
            return redirect()->back()
                ->with('error', 'Stok produk tidak mencukupi untuk jumlah yang Anda minta.')
                ->withInput();
        }

        // Calculate total price
        $subtotal = $product->price * $request->quantity;
        $total = $subtotal + $shippingMethod->price;

        DB::beginTransaction();

        try {
            // Create order
            $order = new Order();
            $order->user_name = $request->user_name;
            $order->email = $request->email;
            $order->address = $request->address;
            $order->total_price = $total;
            $order->payment_method = 'transfer_bank'; // Default method
            $order->payment_status = 'pending';
            $order->shipping_status = 'proses';
            $order->shipping_method_id = $request->shipping_method_id;
            $order->save();

            // Create order item
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->quantity = $request->quantity;
            $orderItem->price = $product->price;
            $orderItem->save();

            // Update product stock
            $product->stock -= $request->quantity;
            $product->save();

            DB::commit();

            // Redirect to success page
            return redirect()->route('shop.order.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            Log::error('Order creation failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show order success page
     */
    public function success($orderId)
    {
        $order = Order::with(['items.product', 'shippingMethod'])->findOrFail($orderId);
        return view('shop.order-success', compact('order'));
    }
}
