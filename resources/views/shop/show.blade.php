<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | ZiyadBook</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit($product->description, 160) }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">

    @if($product->meta_pixel_id)
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
        fbq('init', '{{ $product->meta_pixel_id }}');
        fbq('track', 'PageView');
        fbq('track', 'ViewContent', {
            content_name: '{{ $product->name }}',
            content_category: '{{ $product->category->name ?? "Uncategorized" }}',
            content_ids: ['{{ $product->id }}'],
            content_type: 'product',
            value: {{ $product->price }},
            currency: 'IDR'
        });
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={{ $product->meta_pixel_id }}&ev=PageView&noscript=1"/>
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
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Breadcrumbs -->
        <nav class="mb-6 text-sm">
            <ol class="flex flex-wrap items-center space-x-2">
                <li><a href="{{ route('shop.products.index') }}" class="text-blue-600 hover:text-blue-800 transition">Home</a></li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                @if($product->category)
                <li><a href="{{ route('shop.products.category', $product->category->id) }}" class="text-blue-600 hover:text-blue-800 transition">{{ $product->category->name }}</a></li>
                <li><span class="text-gray-500 mx-2">/</span></li>
                @endif
                <li class="text-gray-700 font-medium truncate max-w-xs">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                <!-- Product Image -->
                <div class="flex justify-center">
                    <div class="w-full max-w-md">
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-contain rounded-lg border border-gray-200">
                        @else
                        <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div>
                    <div class="flex flex-col space-y-4">
                        <!-- Product Title and Category -->
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                            <div class="mt-1">
                                @if($product->category)
                                <a href="{{ route('shop.products.category', $product->category->id) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $product->category->name }}
                                </a>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    Uncategorized
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="text-2xl font-bold text-blue-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <!-- Availability Badge -->
                        <div>
                            @if($product->stock > 0)
                                @if($product->stock <= 5)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Limited Stock ({{ $product->stock }} left)
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    In Stock ({{ $product->stock }} available)
                                </span>
                                @endif
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Out of Stock
                                </span>
                            @endif
                        </div>

                        <!-- Product Description -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 mb-2">Description</h2>
                            <div class="text-gray-600 space-y-2 leading-relaxed">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>

                        @if($product->stock > 0)
                        <!-- Order Form -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <form action="{{ route('shop.order.store') }}" method="POST" id="order-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <!-- Quantity Selector -->
                                <div class="mb-4">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                    <div class="flex items-center">
                                        <button type="button" id="decrease-qty" class="p-2 border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-l-md transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                               class="quantity-input p-2 w-16 text-center border-t border-b border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                        <button type="button" id="increase-qty" class="p-2 border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-r-md transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </button>
                                        <span class="ml-3 text-sm text-gray-500">Maximum {{ $product->stock }} units</span>
                                    </div>
                                </div>

                                <!-- Shipping Method -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Shipping Method</label>
                                    <div class="space-y-2">
                                        @foreach($shippingMethods as $method)
                                        <label class="flex items-center p-3 border rounded-md shipping-method-label hover:border-blue-500 hover:bg-blue-50 cursor-pointer">
                                            <input type="radio" name="shipping_method_id" value="{{ $method->id }}"
                                                {{ $loop->first ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                            <div class="ml-3 flex-1">
                                                <div class="flex justify-between">
                                                    <span class="font-medium text-gray-900">{{ $method->name }}</span>
                                                    <span class="text-blue-600 font-medium">Rp {{ number_format($method->price, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Add this new Payment Method section -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                    <div class="space-y-2">
                                        <label class="flex items-center p-3 border rounded-md payment-method-label hover:border-blue-500 hover:bg-blue-50 cursor-pointer">
                                            <input type="radio" name="payment_method" value="transfer_bank"
                                                   checked
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500" id="payment_transfer">
                                            <div class="ml-3 flex-1">
                                                <span class="font-medium text-gray-900">Bank Transfer</span>
                                                <p class="text-sm text-gray-500">Pay via bank transfer and upload your payment proof</p>
                                            </div>
                                        </label>

                                        <label class="flex items-center p-3 border rounded-md payment-method-label hover:border-blue-500 hover:bg-blue-50 cursor-pointer">
                                            <input type="radio" name="payment_method" value="cod"
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500" id="payment_cod">
                                            <div class="ml-3 flex-1">
                                                <span class="font-medium text-gray-900">Cash on Delivery (COD)</span>
                                                <p class="text-sm text-gray-500">Pay when you receive your order</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Bank Transfer Details (initially visible) -->
                                <div id="bank_transfer_details" class="mb-6 p-4 bg-blue-50 rounded-md border border-blue-200">
                                    <h4 class="font-medium text-gray-900 mb-2">Bank Transfer Information</h4>
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
                                    </div>
                                    <p class="text-sm text-gray-600">Please transfer the exact amount and upload your payment proof after completing your order.</p>
                                </div>

                                <!-- COD Information (initially hidden) -->
                                <div id="cod_details" class="mb-6 p-4 bg-green-50 rounded-md border border-green-200" style="display: none;">
                                    <h4 class="font-medium text-gray-900 mb-2">Cash on Delivery Information</h4>
                                    <p class="text-sm text-gray-600 mb-4">After placing your order, you'll be connected to our WhatsApp for confirmation.</p>
                                    <div class="flex items-center text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Fast confirmation</span>
                                    </div>
                                </div>

                                <!-- Customer Information -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Your Information</h3>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                            <input type="text" id="user_name" name="user_name" required
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <input type="email" id="email" name="email" required
                                                   class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                                            <textarea id="address" name="address" rows="3" required
                                                      class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="w-full btn-primary flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    Order Now
                                </button>
                            </form>
                        </div>
                        @else
                        <!-- Out of Stock -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <button disabled class="w-full py-3 px-4 bg-gray-400 text-white font-medium rounded-md cursor-not-allowed">
                                Out of Stock
                            </button>
                            <p class="mt-2 text-sm text-gray-600 text-center">
                                This product is currently out of stock. Please check back later.
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="book-card bg-white rounded-lg overflow-hidden shadow">
                    <a href="{{ route('shop.products.show', $relatedProduct->id) }}">
                        <div class="h-48 overflow-hidden">
                            @if($relatedProduct->image)
                            <img src="{{ asset($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            @endif
                        </div>
                    </a>
                    <div class="p-4">
                        <div class="text-xs text-blue-600 mb-1">{{ $relatedProduct->category->name ?? 'Uncategorized' }}</div>
                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-2 h-12">{{ $relatedProduct->name }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2 h-10">
                            {{ \Illuminate\Support\Str::limit($relatedProduct->description, 60) }}
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-900">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                            <a href="{{ route('shop.products.show', $relatedProduct->id) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    <script src="{{ asset('js/shop.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity buttons
        const decreaseBtn = document.getElementById('decrease-qty');
        const increaseBtn = document.getElementById('increase-qty');
        const quantityInput = document.getElementById('quantity');
        const maxStock = {{ $product->stock }};

        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
            }
        });

        // Payment method toggle
        const paymentTransfer = document.getElementById('payment_transfer');
        const paymentCod = document.getElementById('payment_cod');
        const bankTransferDetails = document.getElementById('bank_transfer_details');
        const codDetails = document.getElementById('cod_details');

        paymentTransfer.addEventListener('change', function() {
            if (this.checked) {
                bankTransferDetails.style.display = 'block';
                codDetails.style.display = 'none';
            }
        });

        paymentCod.addEventListener('change', function() {
            if (this.checked) {
                bankTransferDetails.style.display = 'none';
                codDetails.style.display = 'block';
            }
        });

        // Form submission
        const orderForm = document.getElementById('order-form');
        orderForm.addEventListener('submit', function(e) {
            if (paymentCod.checked) {
                e.preventDefault();
                // Get form data
                const formData = new FormData(orderForm);
                const userName = formData.get('user_name');
                const productName = "{{ $product->name }}";
                const quantity = formData.get('quantity');
                const address = formData.get('address');

                // Create WhatsApp message
                const message = `Hello, I would like to place a COD order:\n\nName: ${userName}\nProduct: ${productName}\nQuantity: ${quantity}\nAddress: ${address}\n\nPlease confirm my order. Thank you!`;
                const encodedMessage = encodeURIComponent(message);

                // Open WhatsApp with pre-filled message
                window.open(`https://wa.me/6281234567890?text=${encodedMessage}`, '_blank');
            }
        });
    });
</script>

</body>
</html>
