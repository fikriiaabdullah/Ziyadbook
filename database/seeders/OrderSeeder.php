<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::create([
            'user_name' => 'Dewi Lestari',
            'email' => 'dewi@example.com',
            'address' => 'Jl. Merpati No. 12, Jakarta',
            'total_price' => 150000.00,
            'payment_method' => 'Bayar di Tempat',
            'payment_status' => 'pending',
            'shipping_status' => 'proses',
            'shipping_method_id' => 1,
        ]);

        Order::create([
            'user_name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'address' => 'Jl. Anggrek No. 45, Bandung',
            'total_price' => 200000.00,
            'payment_method' => 'Transfer Bank',
            'payment_status' => 'paid',
            'shipping_status' => 'dikirim',
            'shipping_method_id' => 2,
        ]);

        Order::create([
            'user_name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'address' => 'Jl. Melati No. 9, Surabaya',
            'total_price' => 125000.00,
            'payment_method' => 'Bayar di Tempat',
            'payment_status' => 'pending',
            'shipping_status' => 'selesai',
            'shipping_method_id' => 1,
        ]);
    }
}
