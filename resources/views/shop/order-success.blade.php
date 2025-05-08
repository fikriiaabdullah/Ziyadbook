<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success | ZiyadBook</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">

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
<body class="bg-gray-50">
    <header id="header" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center text-2xl font-bold text-blue-600">
                ZiyadBook
            </a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('shop.products.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Shop</a>
                <a href="{{ route('shop.products.index') }}#categories" class="text-gray-700 hover:text-blue-600 font-medium transition">Categories</a>
                <a href="{{ route('shop.products.index') }}#products" class="text-gray-700 hover:text-blue-600 font-medium transition">All Books</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="text-gray-700 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </a>
                <button class="md:hidden text-gray-700" id="mobileMenuBtn" aria-label="Open mobile menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <div class="mobile-nav fixed inset-0 bg-white z-50 transform -translate-x-full transition-transform duration-300 ease-in-out" id="mobileNav">
        <div class="flex justify-between items-center p-4 border-b">
            <a href="/" class="text-2xl font-bold text-blue-600">
                ZiyadBook
            </a>
            <button class="text-gray-700" id="closeMenu" aria-label="Close mobile menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="p-4 flex flex-col space-y-4">
            <a href="{{ route('shop.products.index') }}" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Shop</a>
            <a href="{{ route('shop.products.index') }}#categories" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Categories</a>
            <a href="{{ route('shop.products.index') }}#products" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">All Books</a>
        </div>
    </div>

    <main class="max-w-3xl mx-auto px-4 py-8 pt-20">
        <div class="bg-white rounded-lg shadow-md overflow-hidden fade-in">
            <div class="p-6 mt-8">
                <div class="flex flex-col items-center text-center mb-8 fade-in-up">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Order Successful!</h1>
                    <p class="text-gray-600">Thank you for your order. Your order has been received and is being processed.</p>
                </div>

                <div class="border-t border-gray-200 pt-6 fade-in-up" style="animation-delay: 0.2s">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Order Information</h3>
                            <div class="bg-gray-50 rounded-md p-4">
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div class="text-gray-500">Order ID:</div>
                                    <div class="font-medium text-gray-900">#{{ $order->id }}</div>
                                    <div class="text-gray-500">Date:</div>
                                    <div class="font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    <div class="text-gray-500">Payment Method:</div>
                                    <div class="font-medium text-gray-900">
                                        {{ $order->payment_method == 'transfer_bank' ? 'Bank Transfer' : 'Cash on Delivery' }}
                                    </div>
                                    <div class="text-gray-500">Payment Status:</div>
                                    <div class="font-medium">
                                        @if($order->payment_status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                        @elseif($order->payment_status == 'paid')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Paid
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Failed
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-sm font-medium text-gray-500 mb-2 mt-4">Customer Information</h3>
                            <div class="bg-gray-50 rounded-md p-4">
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div class="text-gray-500">Name:</div>
                                    <div class="font-medium text-gray-900">{{ $order->user_name }}</div>
                                    <div class="text-gray-500">Email:</div>
                                    <div class="font-medium text-gray-900">{{ $order->email }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Shipping Information</h3>
                            <div class="bg-gray-50 rounded-md p-4">
                                <div class="grid grid-cols-1 gap-2 text-sm">
                                    <div class="text-gray-500">Address:</div>
                                    <div class="font-medium text-gray-900">{{ $order->address }}</div>
                                    <div class="text-gray-500">Province:</div>
                                    <div class="font-medium text-gray-900">{{ $provinceName }}</div>
                                    <div class="text-gray-500">City:</div>
                                    <div class="font-medium text-gray-900">{{ $cityName }}</div>
                                    <div class="text-gray-500">Courier:</div>
                                    <div class="font-medium text-gray-900">{{ strtoupper($order->courier) }} - {{ $order->courier_service }}</div>
                                    <div class="text-gray-500">Shipping Status:</div>
                                    <div class="font-medium">
                                        @if($order->shipping_status == 'proses')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Processing
                                        </span>
                                        @elseif($order->shipping_status == 'dikirim')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Shipped
                                        </span>
                                        @elseif($order->shipping_status == 'selesai')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Delivered
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 mt-6 fade-in-up" style="animation-delay: 0.3s">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Items</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->product->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                        Shipping Cost:
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                        Total:
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                @if($order->payment_method == 'transfer_bank' && (!$order->payment || $order->payment->status == 'pending'))
                <div class="border-t border-gray-200 pt-6 mt-6 fade-in-up" style="animation-delay: 0.4s">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Payment Instructions</h2>
                    <div class="bg-blue-50 rounded-md p-4 mb-4">
                        <h3 class="font-medium text-gray-900 mb-2">Bank Transfer Information</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bank</span>
                                <span class="font-medium">BCA</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Account Number</span>
                                <span class="font-medium">1234567890</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Account Name</span>
                                <span class="font-medium">PT. ZiyadBook</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Amount</span>
                                <span class="font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Please transfer the exact amount and upload your payment proof below.</p>

                        <form action="{{ route('shop.payment.upload', $order) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                            @csrf
                            <div class="mb-4">
                                <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-1">Upload Payment Proof</label>
                                <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required
                                       class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Accepted formats: JPG, PNG. Max size: 2MB</p>
                            </div>
                            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-105 active:scale-95">
                                Upload Payment Proof
                            </button>
                        </form>
                    </div>
                </div>
                @endif

                <div class="border-t border-gray-200 pt-6 mt-6 flex justify-center fade-in-up" style="animation-delay: 0.5s">
                    <a href="{{ route('shop.products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-105 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white mt-12 border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} ZiyadBook. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="{{ asset('js/shop.js') }}"></script>
</body>
</html>
