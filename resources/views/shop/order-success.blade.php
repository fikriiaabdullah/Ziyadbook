<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful - #{{ $order->id }} | ZiyadBook</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f7ff;
        }
        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
    </style>

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
<body>
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo and Brand Name -->
                <div class="flex items-center space-x-2">
                    <h1 class="text-2xl font-bold text-blue-600">
                        <a href="{{ route('shop.products.index') }}" class="flex items-center">
                            ZiyadBook
                        </a>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 sm:p-10">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Order Successful!</h1>
                    <p class="text-gray-600 mt-2">Thank you for your order. Your order #{{ $order->id }} has been received.</p>
                </div>

                <div class="border border-gray-200 rounded-md mb-8">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Order Details</h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">Products</h3>
                            <div class="space-y-4">
                                @foreach($order->items as $item)
                                <div class="flex items-start">
                                    @if($item->product->image)
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-md mr-4">
                                    @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-md mr-4 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
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
                                <h3 class="font-medium text-gray-900 mb-2">Contact Information</h3>
                                <div class="text-gray-600">
                                    <p>{{ $order->user_name }}</p>
                                    <p>{{ $order->email }}</p>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900 mb-2">Shipping Address</h3>
                                <p class="text-gray-600">{{ $order->address }}</p>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">Shipping Method</h3>
                            <p class="text-gray-600">{{ $order->shippingMethod->name }}</p>
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-900 mb-2">Payment Method</h3>
                            <p class="text-gray-600">Bank Transfer</p>
                        </div>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-md mb-8">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold">Payment Instructions</h2>
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
                                        Please make payment within 24 hours to process your order.
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($order->payment_method == 'transfer_bank')
                            <p class="font-medium mb-4">Please transfer the amount of:</p>
                            <p class="text-2xl font-bold text-blue-600 mb-6">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                            <div class="space-y-4 mb-6">
                                <div class="border border-gray-200 rounded-md p-4">
                                    <p class="font-medium">Bank BCA</p>
                                    <p>Account Number: 1234567890</p>
                                    <p>Account Name: PT. ZiyadBook</p>
                                </div>
                            </div>

                            <!-- Payment Proof Upload Form -->
                            <div class="mt-6 bg-blue-50 p-4 rounded-md">
                                <h3 class="font-medium text-gray-900 mb-3">Upload Payment Proof</h3>
                                <form action="{{ route('shop.payment.upload', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-1">Payment Screenshot/Photo</label>
                                        <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <p class="mt-1 text-xs text-gray-500">Accepted formats: JPG, PNG, JPEG. Max size: 2MB</p>
                                    </div>
                                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                                        Upload Payment Proof
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="bg-green-50 p-4 rounded-md">
                                <h3 class="font-medium text-gray-900 mb-3">Cash on Delivery</h3>
                                <p class="text-gray-600 mb-4">You've selected Cash on Delivery as your payment method.</p>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    <a href="https://wa.me/6281234567890?text=Hi%2C%20I%20want%20to%20confirm%20my%20order%20%23{{ $order->id }}"
                                       class="text-green-600 font-medium hover:text-green-800" target="_blank">
                                        Contact us on WhatsApp to confirm your order
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('shop.products.index') }}" class="btn-primary inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Shop
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">ZiyadBook</h3>
                    <p class="text-gray-400 text-sm">Your trusted source for quality books at affordable prices.</p>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-semibold mb-4">Contact Us</h4>
                    <address class="not-italic text-sm text-gray-400">
                        <p>Email: info@ziyadbook.com</p>
                        <p>Phone: +62 812 3456 7890</p>
                        <p>Address: Jl. Contoh No. 123, Jakarta</p>
                    </address>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} ZiyadBook. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
