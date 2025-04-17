<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - #{{ $order->id }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    @if($order->items[0]->product->meta_pixel_id)
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $order->items[0]->product->meta_pixel_id }}');
        fbq('track', 'PageView');
        fbq('track', 'Purchase', {
            value: {{ $order->total_price }},
            currency: 'IDR',
            content_ids: [@foreach($order->items as $item)'{{ $item->product_id }}'@if(!$loop->last),@endif @endforeach],
            content_type: 'product'
        });
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={{ $order->items[0]->product->meta_pixel_id }}&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->
    @endif
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Pesanan Berhasil!</h1>
                <p class="text-gray-600 mt-2">Terima kasih atas pesanan Anda. Pesanan #{{ $order->id }} telah diterima.</p>
            </div>

            <div class="border border-gray-200 rounded-md mb-8">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Detail Pesanan</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Produk</h3>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                            <div class="flex items-start">
                                @if($item->product->image)
                                <img src="{{ asset( $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                @else
                                <div class="w-16 h-16 bg-gray-200 rounded-md mr-4 flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No Image</span>
                                </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-medium">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-800 font-medium">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Kontak</h3>
                            <div class="text-gray-600">
                                <p>{{ $order->user_name }}</p>
                                <p>{{ $order->email }}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">Alamat Pengiriman</h3>
                            <p class="text-gray-600">{{ $order->address }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Metode Pengiriman</h3>
                        <p class="text-gray-600">{{ $order->shippingMethod->name }}</p>
                    </div>

                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Metode Pembayaran</h3>
                        <p class="text-gray-600">Transfer Bank</p>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 rounded-md mb-8">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold">Instruksi Pembayaran</h2>
                </div>
                <div class="p-6">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Silakan lakukan pembayaran dalam waktu 24 jam untuk memproses pesanan Anda.
                                </p>
                            </div>
                        </div>
                    </div>

                    <p class="font-medium mb-4">Harap transfer sejumlah:</p>
                    <p class="text-2xl font-bold text-blue-600 mb-6">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                    <div class="space-y-4">
                        <div class="border border-gray-200 rounded-md p-4">
                            <p class="font-medium">Bank BCA</p>
                            <p>No. Rekening: 1234567890</p>
                            <p>Atas Nama: PT. Nama Perusahaan</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <p class="text-gray-600 text-sm">Setelah melakukan pembayaran, silakan konfirmasi melalui WhatsApp ke nomor <span class="font-medium">081234567890</span> dengan menyertakan bukti transfer dan nomor pesanan.</p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('shop.products.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Kembali ke Toko
                </a>
            </div>
        </div>
    </div>
</body>
</html>
