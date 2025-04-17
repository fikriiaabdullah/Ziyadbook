<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil order yang sudah ada
        $order1 = Order::where('user_name', 'Dewi Lestari')->first();
        $order2 = Order::where('user_name', 'Budi Santoso')->first();
        $order3 = Order::where('user_name', 'Siti Aminah')->first();

        // Produk yang bisa dipilih (gunakan produk yang sudah ada di database)
        $product1 = Product::first();  // Misalnya, ambil produk pertama
        $product2 = Product::skip(1)->first();  // Ambil produk kedua
        $product3 = Product::skip(2)->first();  // Ambil produk ketiga

        // Order 1 - Dewi Lestari
        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $product1->id,
            'quantity' => 2,
            'price' => 50000.00, // Harga per produk
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $product2->id,
            'quantity' => 1,
            'price' => 100000.00, // Harga per produk
        ]);

        // Order 2 - Budi Santoso
        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $product1->id,
            'quantity' => 1,
            'price' => 50000.00,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $product3->id,
            'quantity' => 3,
            'price' => 66666.67,
        ]);

        // Order 3 - Siti Aminah
        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => $product2->id,
            'quantity' => 2,
            'price' => 62500.00,
        ]);
    }
}
