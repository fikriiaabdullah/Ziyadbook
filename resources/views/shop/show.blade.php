<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="origin-city" content="{{ $originCity }}">
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
<body class="bg-background">
    <header id="header" class="bg-white shadow-sm sticky top-0 z-50">
        <div class="header-container container">
            <a href="/" class="logo">
                ZiyadBook
            </a>
            <div class="nav-links">
                <a href="{{ route('shop.products.index') }}" class="nav-link">Shop</a>
                <a href="{{ route('shop.products.index') }}#categories" class="nav-link">Categories</a>
                <a href="{{ route('shop.products.index') }}#products" class="nav-link">All Books</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="cart-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </a>
            </div>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Open mobile menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </header>

    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <a href="/" class="logo">
                ZiyadBook
            </a>
            <button class="close-menu" id="closeMenu" aria-label="Close mobile menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="mobile-nav-links">
            <a href="{{ route('shop.products.index') }}" class="mobile-nav-link">Shop</a>
            <a href="{{ route('shop.products.index') }}#categories" class="mobile-nav-link">Categories</a>
            <a href="{{ route('shop.products.index') }}#products" class="mobile-nav-link">All Books</a>
        </div>
    </div>

    <main class="pt-6">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            @if(session('error'))
                <div class="alert alert-error animate-fade-in">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Breadcrumbs -->
            <nav class="mb-4 text-sm animate-fade-in">
                <ol class="flex flex-wrap items-center space-x-2">
                    <li><a href="{{ route('shop.products.index') }}" class="text-accent hover:text-primary transition">Home</a></li>
                    <li><span class="text-gray-500 mx-2">/</span></li>
                    @if($product->category)
                    <li><a href="{{ route('shop.products.category', $product->category->id) }}" class="text-accent hover:text-primary transition">{{ $product->category->name }}</a></li>
                    <li><span class="text-gray-500 mx-2">/</span></li>
                    @endif
                    <li class="text-text font-medium truncate max-w-xs">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="bg-card rounded-lg shadow-md overflow-hidden animate-fade-in">
                <!-- Product Title at the top -->
                <div class="p-6 pb-0 animate-fade-in-up" style="animation-delay: 0.1s">
                    <h1 class="text-2xl md:text-3xl font-bold text-text">{{ $product->name }}</h1>
                    <div class="mt-2 mb-4">
                        @if($product->category)
                        <a href="{{ route('shop.products.category', $product->category->id) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-accent-light text-accent transition hover:bg-accent hover:text-white">
                            {{ $product->category->name }}
                        </a>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Uncategorized
                        </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 p-6 pt-2">
                    <!-- Product Image with Zoom -->
                    <div class="lg:col-span-4 flex justify-center">
                        <div class="w-full max-w-md">
                            <div class="product-image-container relative rounded-lg overflow-hidden border border-border">
                                @if($product->image)
                                <div class="zoom-container cursor-zoom-in">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-contain product-main-image">
                                </div>
                                @else
                                <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                @endif

                                <!-- Zoom lens overlay (hidden by default) -->
                                <div id="zoom-lens" class="hidden absolute pointer-events-none border border-accent"></div>
                            </div>

                            <!-- Zoomed view (hidden by default) -->
                            <div id="zoom-result" class="hidden fixed top-1/4 right-1/4 w-64 h-64 border border-accent bg-white rounded-lg shadow-lg z-50"></div>

                            <!-- Product badges -->
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                @if($product->stock <= 5 && $product->stock > 0)
                                <span class="badge-pulse px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Limited Stock</span>
                                @elseif($product->stock <= 0)
                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="lg:col-span-8">
                        <div class="flex flex-col space-y-4">
                            <!-- Price -->
                            <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                                <div class="text-3xl font-bold text-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Availability Badge -->
                            <div class="animate-fade-in-up" style="animation-delay: 0.3s">
                                @if($product->stock > 0)
                                    @if($product->stock <= 5)
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Limited Stock ({{ $product->stock }} left)
                                        </span>
                                        <div class="stock-bar ml-3 bg-gray-200 h-2 w-24 rounded-full overflow-hidden">
                                            <div class="bg-yellow-500 h-full rounded-full" style="width: {{ min(($product->stock / 10) * 100, 100) }}%"></div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            In Stock ({{ $product->stock }} available)
                                        </span>
                                        <div class="stock-bar ml-3 bg-gray-200 h-2 w-24 rounded-full overflow-hidden">
                                            <div class="bg-green-500 h-full rounded-full" style="width: {{ min(($product->stock / 20) * 100, 100) }}%"></div>
                                        </div>
                                    </div>
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
                            <div class="animate-fade-in-up" style="animation-delay: 0.4s">
                                <h2 class="text-lg font-medium text-text mb-2">Description</h2>
                                <div class="text-text-light space-y-2 leading-relaxed bg-background p-4 rounded-lg border border-border">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>

                            @if($product->stock > 0)
                            <!-- Order Form -->
                            <div class="mt-6 pt-6 border-t border-border animate-fade-in-up" style="animation-delay: 0.5s">
                                <form action="{{ route('shop.order.store') }}" method="POST" id="order-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
                                    <input type="hidden" name="courier_service" id="courier_service" value="">

                                    <!-- Quantity Selector -->
                                    <div class="mb-4">
                                        <label for="quantity" class="block text-sm font-medium text-text mb-2">Quantity</label>
                                        <div class="flex items-center">
                                            <button type="button" id="decrease-qty" class="p-2 border border-border bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-l-md transition transform hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                                class="quantity-input p-2 w-16 text-center border-t border-b border-border focus:ring-accent focus:border-accent outline-none">
                                            <button type="button" id="increase-qty" class="p-2 border border-border bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-r-md transition transform hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </button>
                                            <span class="ml-3 text-sm text-text-light">Maximum {{ $product->stock }} units</span>
                                        </div>
                                    </div>

                                    <!-- Order Information Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Left Column: Shipping & Payment -->
                                        <div>
                                            <!-- Customer Information -->
                                            <div class="mb-6 bg-white p-4 rounded-lg border border-border shadow-sm">
                                                <h3 class="text-lg font-medium text-text mb-4 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    Your Information
                                                </h3>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="user_name" class="block text-sm font-medium text-text mb-1">Full Name</label>
                                                        <input type="text" id="user_name" name="user_name" required
                                                            class="w-full p-2 border border-border rounded-md focus:ring-accent focus:border-accent transition">
                                                    </div>
                                                    <div>
                                                        <label for="email" class="block text-sm font-medium text-text mb-1">Email</label>
                                                        <input type="email" id="email" name="email" required
                                                            class="w-full p-2 border border-border rounded-md focus:ring-accent focus:border-accent transition">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Shipping Address -->
                                            <div class="mb-6 bg-white p-4 rounded-lg border border-border shadow-sm">
                                                <h3 class="text-lg font-medium text-text mb-4 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    Shipping Information
                                                </h3>
                                                <div class="grid grid-cols-1 gap-4">
                                                    <!-- Province Selection -->
                                                    <div>
                                                        <label for="province_id" class="block text-sm font-medium text-text mb-1">Province</label>
                                                        <select id="province_id" name="province_id" class="w-full p-2 border border-border rounded-md focus:ring-accent focus:border-accent transition" required>
                                                            <option value="">Select Province</option>
                                                            @foreach($provinces as $province)
                                                            <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- City Selection -->
                                                    <div>
                                                        <label for="city_id" class="block text-sm font-medium text-text mb-1">City</label>
                                                        <select id="city_id" name="city_id" class="w-full p-2 border border-border rounded-md focus:ring-accent focus:border-accent transition" required disabled>
                                                            <option value="">Select City</option>
                                                        </select>
                                                    </div>

                                                    <!-- Address -->
                                                    <div>
                                                        <label for="address" class="block text-sm font-medium text-text mb-1">Detailed Address</label>
                                                        <textarea id="address" name="address" rows="3" required
                                                                class="w-full p-2 border border-border rounded-md focus:ring-accent focus:border-accent transition" placeholder="Street name, building number, etc."></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Courier Selection -->
                                            <div class="mb-6 bg-white p-4 rounded-lg border border-border shadow-sm">
                                                <label class="block text-sm font-medium text-text mb-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                                    </svg>
                                                    Courier
                                                </label>
                                                <div class="space-y-2">
                                                    @foreach($couriers as $code => $name)
                                                    <label class="flex items-center p-3 border rounded-md courier-option hover:border-accent hover:bg-accent-light cursor-pointer transition transform hover:scale-[1.01]">
                                                        <input type="radio" name="courier" value="{{ $code }}"
                                                            {{ $loop->first ? 'checked' : '' }}
                                                            class="h-4 w-4 text-accent focus:ring-accent courier-radio">
                                                        <div class="ml-3 flex-1">
                                                            <span class="font-medium text-text">{{ $name }}</span>
                                                        </div>
                                                    </label>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Shipping Services (will be populated via AJAX) -->
                                            <div class="mb-6 bg-white p-4 rounded-lg border border-border shadow-sm" id="shipping-services-container" style="display: none;">
                                                <label class="block text-sm font-medium text-text mb-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    Shipping Service
                                                </label>
                                                <div id="shipping-services-loading" class="p-3 text-center">
                                                    <div class="loading-spinner"></div> Loading shipping options...
                                                </div>
                                                <div class="space-y-2" id="shipping-services">
                                                    <!-- Shipping services will be inserted here -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right Column: Payment & Summary -->
                                        <div>
                                            <!-- Payment Method -->
                                            <div class="mb-6 bg-white p-4 rounded-lg border border-border shadow-sm">
                                                <label class="block text-sm font-medium text-text mb-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                    Payment Method
                                                </label>
                                                <div class="space-y-2">
                                                    <label class="flex items-center p-3 border rounded-md payment-method-label hover:border-accent hover:bg-accent-light cursor-pointer transition transform hover:scale-[1.01]">
                                                        <input type="radio" name="payment_method" value="transfer_bank"
                                                            checked
                                                            class="h-4 w-4 text-accent focus:ring-accent" id="payment_transfer">
                                                        <div class="ml-3 flex-1">
                                                            <span class="font-medium text-text">Bank Transfer</span>
                                                            <p class="text-sm text-text-light">Pay via bank transfer and upload your payment proof</p>
                                                        </div>
                                                    </label>

                                                    <label class="flex items-center p-3 border rounded-md payment-method-label hover:border-accent hover:bg-accent-light cursor-pointer transition transform hover:scale-[1.01]">
                                                        <input type="radio" name="payment_method" value="cod"
                                                            class="h-4 w-4 text-accent focus:ring-accent" id="payment_cod">
                                                        <div class="ml-3 flex-1">
                                                            <span class="font-medium text-text">Cash on Delivery (COD)</span>
                                                            <p class="text-sm text-text-light">Pay when you receive your order</p>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Bank Transfer Details (initially visible) -->
                                            <div id="bank_transfer_details" class="mb-6 p-4 bg-accent-light rounded-lg border border-accent-light shadow-sm transition-all">
                                                <h4 class="font-medium text-text mb-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                    </svg>
                                                    Bank Transfer Information
                                                </h4>
                                                <div class="space-y-2 mb-4">
                                                    <div class="flex justify-between">
                                                        <span class="text-text-light">Bank</span>
                                                        <span class="font-medium">BCA</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-text-light">Account Number</span>
                                                        <span class="font-medium">1234567890</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-text-light">Account Name</span>
                                                        <span class="font-medium">PT. ZiyadBook</span>
                                                    </div>
                                                </div>
                                                <p class="text-sm text-text-light">Please transfer the exact amount and upload your payment proof after completing your order.</p>
                                            </div>

                                            <!-- COD Information (initially hidden) -->
                                            <div id="cod_details" class="mb-6 p-4 bg-green-50 rounded-lg border border-green-200 shadow-sm transition-all" style="display: none;">
                                                <h4 class="font-medium text-text mb-2 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                    </svg>
                                                    Cash on Delivery Information
                                                </h4>
                                                <p class="text-sm text-text-light mb-4">After placing your order, you'll be connected to our WhatsApp for confirmation.</p>
                                                <div class="flex items-center text-green-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span>Fast confirmation</span>
                                                </div>
                                            </div>

                                            <!-- Order Summary -->
                                            <div class="mb-6 p-4 bg-white rounded-lg border border-border shadow-sm">
                                                <h4 class="font-medium text-text mb-4 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    Order Summary
                                                </h4>
                                                <div class="space-y-3">
                                                    <div class="flex items-center p-3 bg-background rounded-lg">
                                                        <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded overflow-hidden mr-3">
                                                            @if($product->image)
                                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                            @else
                                                            <div class="w-full h-full flex items-center justify-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                                </svg>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-1">
                                                            <h5 class="font-medium text-text text-sm">{{ $product->name }}</h5>
                                                            <p class="text-text-light text-xs">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="space-y-2 pt-3">
                                                        <div class="flex justify-between">
                                                            <span class="text-text-light">Product Price</span>
                                                            <span class="font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <span class="text-text-light">Quantity</span>
                                                            <span class="font-medium" id="summary-quantity">1</span>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <span class="text-text-light">Subtotal</span>
                                                            <span class="font-medium" id="summary-subtotal">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <span class="text-text-light">Shipping Cost</span>
                                                            <span class="font-medium" id="summary-shipping">Rp 0</span>
                                                        </div>
                                                        <div class="border-t border-border pt-3 mt-3">
                                                            <div class="flex justify-between font-bold text-lg">
                                                                <span>Total</span>
                                                                <span id="summary-total" class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Shipping Address Summary -->
                                                    <div class="mt-4 pt-4 border-t border-border">
                                                        <h5 class="font-medium text-text text-sm mb-2">Shipping Address:</h5>
                                                        <div class="text-sm text-text-light bg-background p-3 rounded-md" id="summary-address">
                                                            <p class="italic text-gray-400">Please fill in your shipping information</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit" class="w-full btn-primary flex items-center justify-center transform transition hover:scale-[1.02] active:scale-[0.98]" id="order-button" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                                Order Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @else
                            <!-- Out of Stock -->
                            <div class="mt-6 pt-6 border-t border-border animate-fade-in-up" style="animation-delay: 0.5s">
                                <button disabled class="w-full py-3 px-4 bg-gray-400 text-white font-medium rounded-md cursor-not-allowed">
                                    Out of Stock
                                </button>
                                <p class="mt-2 text-sm text-text-light text-center">
                                    This product is currently out of stock. Please check back later.
                                </p>
                            </div>
                            @endif
                                    </div>
                                </div>
                            </div>
        </div>
    </main>

    <script src="{{ asset('js/shop.js') }}"></script>
</body>
</html>
