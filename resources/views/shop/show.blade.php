<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit($product->description, 160) }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.css" rel="stylesheet">
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
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header with sticky navigation -->
    <header class="bg-white shadow sticky-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo and Brand Name -->
                <div class="flex items-center space-x-2">
                    <h1 class="text-2xl font-bold text-blue-600">
                        <a href="{{ route('shop.products.index') }}" class="flex items-center">
                            <i class="fas fa-store mr-2"></i>
                            <span>Toko Online</span>
                        </a>
                    </h1>
                </div>

                <!-- Navigation -->
                <nav class="flex items-center space-x-8">
                    <a href="{{ route('shop.products.index') }}" class="text-gray-600 hover:text-blue-600 transition">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>

                    <a href="{{ route('shop.products.index') }}" class="text-gray-600 hover:text-blue-600 transition flex items-center">
                        <i class="fas fa-box-open mr-1"></i> Produk
                    </a>

                    <a href="https://api.whatsapp.com/send/?phone=6282243431114&text=Hai+Kak%2C+saya+ingin+bertanya+tentang+produk"
                        target="_blank"
                        class="text-gray-600 hover:text-blue-600 transition">
                        <i class="fab fa-whatsapp mr-1"></i> Kontak
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button type="button" class="md:hidden text-gray-600 hover:text-blue-600" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation (Hidden by default) -->
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 z-20 hidden" id="mobile-menu-overlay"></div>
        <div class="fixed inset-y-0 left-0 max-w-xs w-full bg-white shadow-xl z-30 mobile-menu p-4" id="mobile-menu">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-blue-600">Menu</h2>
                <button type="button" class="text-gray-400 hover:text-gray-500" id="close-mobile-menu">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('shop.products.index') }}" class="py-2 text-gray-600 hover:text-blue-600 border-b border-gray-100 flex items-center">
                    <i class="fas fa-home w-8"></i> Home
                </a>
                <a href="{{ route('shop.products.index') }}" class="py-2 text-gray-600 hover:text-blue-600 border-b border-gray-100 flex items-center">
                    <i class="fas fa-box-open w-8"></i> Produk
                </a>
                <a href="#" class="py-2 text-gray-600 hover:text-blue-600 border-b border-gray-100 flex items-center">
                    <i class="fas fa-info-circle w-8"></i> Tentang Kami
                </a>
                <a href="#" class="py-2 text-gray-600 hover:text-blue-600 border-b border-gray-100 flex items-center">
                    <i class="fas fa-envelope w-8"></i> Kontak
                </a>
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-md mb-6 animate__animated animate__fadeIn" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Breadcrumbs -->
        <nav class="mb-6 text-sm">
            <ol class="flex flex-wrap items-center space-x-2">
                <li><a href="{{ route('shop.products.index') }}" class="text-blue-600 hover:text-blue-800 transition">Home</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                @if($product->category)
                <li><a href="{{ route('shop.products.category', $product->category->id) }}" class="text-blue-600 hover:text-blue-800 transition">{{ $product->category->name }}</a></li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                @endif
                <li class="text-gray-700 font-medium truncate max-w-xs">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl shadow-md overflow-hidden fade-in border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                <!-- Product Image Gallery -->
                <div class="space-y-4">
                    <!-- Main Image with zoom effect -->
                    <div class="zoom-container rounded-lg overflow-hidden bg-gray-50 border border-gray-200">
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" id="main-product-image"
                             class="w-full h-auto object-contain aspect-square">
                        @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center rounded-lg">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                        @endif
                    </div>

                    <!-- Thumbnails (simulated - in a real store you'd have multiple images) -->
                    <div class="flex space-x-2 overflow-x-auto pb-2">
                        @if($product->image)
                        <div class="image-gallery-thumb active border-2 border-blue-400 rounded cursor-pointer flex-shrink-0" data-src="{{ asset($product->image) }}">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                        </div>
                        <!-- Simulated additional images -->
                        <div class="image-gallery-thumb border-2 border-gray-200 rounded cursor-pointer flex-shrink-0" data-src="{{ asset($product->image) }}">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                        </div>
                        <div class="image-gallery-thumb border-2 border-gray-200 rounded cursor-pointer flex-shrink-0" data-src="{{ asset($product->image) }}">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div>
                    <div class="flex flex-col space-y-4">
                        <!-- Product Title and Category -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                            <div class="mt-1">
                                @if($product->category)
                                <a href="{{ route('shop.products.category', $product->category->id) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition">
                                    <i class="fas fa-tag mr-1 text-xs"></i>
                                    {{ $product->category->name }}
                                </a>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-tag mr-1 text-xs"></i>
                                    Uncategorized
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Price and Rating -->
                        <div class="flex items-center justify-between">
                            <div class="text-3xl font-bold text-blue-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <!-- Simulated rating -->
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-1 text-gray-600 text-sm">(24 ulasan)</span>
                            </div>
                        </div>

                        <!-- Availability Badge -->
                        <div>
                            @if($product->stock > 0)
                                @if($product->stock <= 5)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 badge-pulse">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Stok Terbatas ({{ $product->stock }} tersisa)
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Tersedia ({{ $product->stock }} tersisa)
                                </span>
                                @endif
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Stok Habis
                                </span>
                            @endif
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-2"></div>

                        <!-- Product Description -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                Deskripsi Produk
                            </h2>
                            <div class="text-gray-600 space-y-2 leading-relaxed">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-2"></div>

                        <!-- Benefits and Features (simulated) -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                                <i class="fas fa-gem mr-2 text-blue-500"></i>
                                Keunggulan
                            </h2>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>Produk berkualitas tinggi</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>Garansi 30 hari</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>Pengiriman cepat</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                                    <span>Layanan purnajual</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-2"></div>

                        @if($product->stock > 0)
                        <!-- Quantity Selector -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Pilih Jumlah</label>
                            <div class="flex items-center">
                                <button type="button" id="decrease-qty" class="p-2 border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-l-md transition">
                                    <i class="fas fa-minus text-sm"></i>
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                       class="quantity-input p-2 w-16 text-center border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <button type="button" id="increase-qty" class="p-2 border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-r-md transition">
                                    <i class="fas fa-plus text-sm"></i>
                                </button>
                                <span class="ml-3 text-sm text-gray-500">Maksimal {{ $product->stock }} unit</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                            <button type="button" id="order-now-btn"
                                    class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Beli Sekarang
                            </button>
                            <!-- Simulated add to cart button -->
                            <button type="button" id="add-to-cart-btn"
                                    class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-6 rounded-lg transition border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                                <i class="fas fa-heart mr-2"></i>
                                Tambah ke Wishlist
                            </button>
                        </div>
                        @else
                        <!-- Out of Stock -->
                        <div class="mt-4">
                            <button disabled
                                    class="w-full flex items-center justify-center bg-gray-400 text-white font-bold py-3 px-6 rounded-lg cursor-not-allowed">
                                <i class="fas fa-ban mr-2"></i>
                                Stok Habis
                            </button>
                            <!-- Notify me button -->
                            <button type="button" id="notify-me-btn"
                                    class="w-full mt-2 flex items-center justify-center bg-white hover:bg-gray-50 text-blue-600 font-semibold py-2 px-6 rounded-lg transition border border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                                <i class="fas fa-bell mr-2"></i>
                                Beri Tahu Saya Jika Tersedia
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Form (Initially Hidden) -->
        @if($product->stock > 0)
        <div id="checkout-form-container" class="mt-8 bg-white rounded-xl shadow-md p-6 hidden border border-gray-100 fade-in">
            <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-credit-card mr-2 text-blue-500"></i>
                    Checkout
                </h2>
                <div>
                    <span class="text-sm text-gray-500">Langkah 1 dari 2</span>
                </div>
            </div>

            <form action="{{ route('shop.order.store') }}" method="POST" id="checkout-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" id="form-quantity" name="quantity" value="1">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Billing Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <i class="fas fa-user-circle mr-2 text-blue-500"></i>
                                Informasi Kontak
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="user_name" class="block text-gray-700 mb-1 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                        <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" required
                                            class="w-full pl-10 px-4 py-2 border @error('user_name') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                    </div>
                                    @error('user_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-gray-700 mb-1 text-sm">Email <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                        </div>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                            class="w-full pl-10 px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                    </div>
                                    @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-gray-700 mb-1 text-sm">Alamat Pengiriman <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-home text-gray-400"></i>
                                </div>
                                <textarea id="address" name="address" rows="3" required
                                    class="w-full pl-10 px-4 py-2 border @error('address') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <i class="fas fa-truck mr-2 text-blue-500"></i>
                                Metode Pengiriman
                            </h3>
                            <div class="space-y-3">
                                @foreach($shippingMethods as $method)
                                <label class="flex items-start p-4 border @if(old('shipping_method_id') == $method->id) border-blue-500 bg-blue-50 @else border-gray-300 @endif rounded-md hover:border-blue-300 hover:bg-blue-50 transition-all cursor-pointer shipping-method-label">
                                    <input type="radio" name="shipping_method_id" value="{{ $method->id }}"
                                        {{ old('shipping_method_id') == $method->id ? 'checked' : ($loop->first ? 'checked' : '') }}
                                        class="mt-1 mr-3 text-blue-600 focus:ring-blue-500 shipping-method-radio">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="font-medium text-gray-800">{{ $method->name }}</p>
                                            <p class="text-blue-600 font-medium">Rp {{ number_format($method->price, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ $method->description }}</p>
                                        <!-- Estimated delivery time (simulated) -->
                                        <p class="text-xs text-gray-500 mt-2">Estimasi pengiriman: 2-3 hari kerja</p>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            @error('shipping_method_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div>
                        <div class="bg-gray-50 rounded-lg p-4 sticky top-20 border border-gray-200">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <i class="fas fa-receipt mr-2 text-blue-500"></i>
                                Ringkasan Pesanan
                            </h3>

                            <div class="flex items-center mb-4 pb-4 border-b border-gray-200">
                                @if($product->image)
                                <div class="relative">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-md">
                                    <span id="summary-quantity-badge" class="absolute -top-2 -right-2 w-5 h-5 flex items-center justify-center text-xs bg-blue-600 text-white rounded-full">1</span>
                                </div>
                                @else
                                <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center relative">
                                    <span class="text-gray-500 text-xs">No Image</span>
                                    <span id="summary-quantity-badge" class="absolute -top-2 -right-2 w-5 h-5 flex items-center justify-center text-xs bg-blue-600 text-white rounded-full">1</span>
                                </div>
                                @endif
                                <div class="ml-4 flex-1">
                                    <h4 class="font-medium text-gray-800">{{ $product->name }}</h4>
                                    <p class="text-gray-600 text-sm">Jumlah: <span id="summary-quantity">1</span></p>
                                    <p class="font-medium text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span id="summary-subtotal" class="font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Pengiriman</span>
                                    <span id="summary-shipping" class="font-medium">-</span>
                                </div>
                                <!-- Simulated tax -->
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Pajak (10%)</span>
                                    <span id="summary-tax" class="font-medium">Rp {{ number_format($product->price * 0.1, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t border-gray-200 my-2 pt-2"></div>
                                <div class="flex justify-between font-bold text-lg">
                                    <span>Total</span>
                                    <span id="summary-total" class="text-blue-600">-</span>
                                </div>
                            </div>

                            <!-- Simulated promo code -->
                            <div class="mb-4">
                                <label for="promo-code" class="block text-sm font-medium text-gray-700 mb-1">Kode Promo</label>
                                <div class="flex">
                                    <input type="text" id="promo-code" class="flex-1 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan kode">
                                    <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-r-md transition">
                                        Terapkan
                                    </button>
                                </div>
                            </div>

                            <div class="flex flex-col space-y-2">
                                <button type="submit" class="flex items-center justify-center py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                    <i class="fas fa-lock mr-2"></i>
                                    Lanjutkan ke Pembayaran
                                </button>
                                <button type="button" id="cancel-checkout-btn" class="flex items-center justify-center py-3 px-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
                                </button>
                            </div>

                            <!-- Trust badges -->
                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <p class="text-center text-sm text-gray-600 mb-2">Pembayaran Aman</p>
                                <div class="flex justify-center space-x-3">
                                    <i class="fab fa-cc-visa text-2xl text-blue-900"></i>
                                    <i class="fab fa-cc-mastercard text-2xl text-red-500"></i>
                                    <i class="fab fa-cc-paypal text-2xl text-blue-700"></i>
                                    <i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif

        <!-- Product Tabs -->
        <div class="mt-12 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="border-b border-gray-200">
                <nav class="flex flex-wrap -mb-px">
                    <button class="product-tab-btn active-tab text-blue-600 border-b-2 border-blue-600 font-medium py-4 px-6 text-center" data-tab="details">
                        <i class="fas fa-info-circle mr-1"></i> Detail Produk
                    </button>
                    <button class="product-tab-btn text-gray-500 hover:text-gray-700 font-medium py-4 px-6 text-center" data-tab="specifications">
                        <i class="fas fa-clipboard-list mr-1"></i> Spesifikasi
                    </button>
                    <button class="product-tab-btn text-gray-500 hover:text-gray-700 font-medium py-4 px-6 text-center" data-tab="reviews">
                        <i class="fas fa-star mr-1"></i> Ulasan (24)
                    </button>
                    <button class="product-tab-btn text-gray-500 hover:text-gray-700 font-medium py-4 px-6 text-center" data-tab="shipping">
                        <i class="fas fa-truck mr-1"></i> Pengiriman
                    </button>
                </nav>
            </div>

            <div class="p-6">
                <!-- Tab content for Details -->
                <div id="details-tab" class="product-tab-content">
                    <div class="prose max-w-none">
                        <h3>Tentang Produk</h3>
                        <p>{!! nl2br(e($product->description)) !!}</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Sed euismod, nisl eget ultricies ultricies, nunc nisl aliquam nunc, vitae aliquam nisl nunc eu nisl. Sed euismod, nisl eget ultricies ultricies, nunc nisl aliquam nunc, vitae aliquam nisl nunc eu nisl.</p>
                        <h3>Fitur Utama</h3>
                        <ul>
                            <li>Kualitas premium dengan bahan pilihan</li>
                            <li>Desain ergonomis untuk kenyamanan maksimal</li>
                            <li>Tahan lama dan mudah dibersihkan</li>
                            <li>Cocok untuk penggunaan sehari-hari</li>
                        </ul>
                    </div>
                </div>

                <!-- Tab content for Specifications -->
                <div id="specifications-tab" class="product-tab-content hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="py-3 px-4 text-sm font-medium text-gray-600 bg-gray-50 w-1/3">SKU</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">PRD-{{ $product->id }}-{{ substr(md5($product->name), 0, 6) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 text-sm font-medium text-gray-600 bg-gray-50">Berat</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">0.5 kg</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 text-sm font-medium text-gray-600 bg-gray-50">Dimensi</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">10 x 15 x 5 cm</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 text-sm font-medium text-gray-600 bg-gray-50">Warna</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">Hitam, Putih, Biru</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 text-sm font-medium text-gray-600 bg-gray-50">Bahan</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">Premium</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 text-sm font-medium text-gray-600 bg-gray-50">Garansi</td>
                                    <td class="py-3 px-4 text-sm text-gray-900">1 Tahun</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab content for Reviews -->
                <div id="reviews-tab" class="product-tab-content hidden">
                    <!-- Overall Rating -->
                    <div class="flex flex-col md:flex-row md:items-center mb-6 pb-6 border-b border-gray-200">
                        <div class="flex-shrink-0 flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg mr-8 mb-4 md:mb-0">
                            <div class="text-5xl font-bold text-blue-600">4.5</div>
                            <div class="flex text-yellow-400 my-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <div class="text-sm text-gray-500">Dari 24 ulasan</div>
                        </div>
                        <div class="flex-1">
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <div class="w-20 text-sm text-gray-600">5 stars</div>
                                    <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400" style="width: 75%"></div>
                                    </div>
                                    <div class="w-10 text-sm text-gray-600 text-right">75%</div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-20 text-sm text-gray-600">4 stars</div>
                                    <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400" style="width: 15%"></div>
                                    </div>
                                    <div class="w-10 text-sm text-gray-600 text-right">15%</div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-20 text-sm text-gray-600">3 stars</div>
                                    <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400" style="width: 5%"></div>
                                    </div>
                                    <div class="w-10 text-sm text-gray-600 text-right">5%</div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-20 text-sm text-gray-600">2 stars</div>
                                    <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400" style="width: 3%"></div>
                                    </div>
                                    <div class="w-10 text-sm text-gray-600 text-right">3%</div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-20 text-sm text-gray-600">1 star</div>
                                    <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400" style="width: 2%"></div>
                                    </div>
                                    <div class="w-10 text-sm text-gray-600 text-right">2%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews list -->
                    <div class="space-y-6">
                        <!-- Review item 1 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                        A
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-gray-900">Andi Wijaya</h4>
                                        <div class="flex items-center mt-1">
                                            <div class="flex text-yellow-400 text-sm">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="ml-2 text-xs text-gray-500">3 hari yang lalu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-500">Verified Purchase <i class="fas fa-check-circle text-green-500"></i></div>
                            </div>
                            <div class="mt-3">
                                <h5 class="text-sm font-medium text-gray-900">Produk berkualitas!</h5>
                                <p class="mt-1 text-sm text-gray-600">Kualitas produk sangat bagus dan sesuai dengan ekspektasi. Pengiriman juga cepat dan aman. Sangat merekomendasikan toko ini untuk pembelian produk serupa.</p>
                            </div>
                        </div>

                        <!-- Review item 2 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold">
                                        B
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-medium text-gray-900">Budi Santoso</h4>
                                        <div class="flex items-center mt-1">
                                            <div class="flex text-yellow-400 text-sm">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <span class="ml-2 text-xs text-gray-500">1 minggu yang lalu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-500">Verified Purchase <i class="fas fa-check-circle text-green-500"></i></div>
                            </div>
                            <div class="mt-3">
                                <h5 class="text-sm font-medium text-gray-900">Cukup puas dengan produknya</h5>
                                <p class="mt-1 text-sm text-gray-600">Produk sesuai dengan deskripsi, hanya saja pengirimannya agak lama. Secara keseluruhan cukup puas dengan pembelian ini.</p>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="text-blue-600 hover:text-blue-800 font-medium flex items-center mx-auto">
                                <span>Lihat semua ulasan</span>
                                <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tab content for Shipping -->
                <div id="shipping-tab" class="product-tab-content hidden">
                    <div class="prose max-w-none">
                        <h3>Informasi Pengiriman</h3>
                        <p>Kami menawarkan beberapa opsi pengiriman untuk memenuhi kebutuhan Anda:</p>
                        <ul>
                            <li><strong>Reguler (2-3 hari kerja)</strong>: Pengiriman standar ke seluruh wilayah Indonesia.</li>
                            <li><strong>Ekspres (1 hari kerja)</strong>: Pengiriman cepat untuk area tertentu (Jawa, Bali, Sumatera).</li>
                            <li><strong>Same Day (6-8 jam)</strong>: Tersedia untuk area Jakarta dan sekitarnya.</li>
                        </ul>
                        <p>Semua pesanan akan diproses dalam 1x24 jam setelah pembayaran dikonfirmasi.</p>

                        <h3>Kebijakan Pengembalian</h3>
                        <p>Kami menerima pengembalian produk dalam waktu 7 hari setelah barang diterima dengan ketentuan:</p>
                        <ul>
                            <li>Produk dalam kondisi asli dan belum digunakan</li>
                            <li>Kemasan lengkap dan tidak rusak</li>
                            <li>Disertai bukti pembelian</li>
                        </ul>
                        <p>Untuk informasi lebih lanjut, silakan hubungi layanan pelanggan kami.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mt-12 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-question-circle mr-2 text-blue-500"></i>
                Pertanyaan yang Sering Diajukan
            </h2>
            <div class="space-y-4">
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition font-medium text-left focus:outline-none" aria-expanded="false">
                        <span>Apakah produk ini bergaransi?</span>
                        <i class="fas fa-chevron-down text-gray-500 transform transition-transform"></i>
                    </button>
                    <div class="faq-answer p-4 border-t border-gray-200 hidden">
                        <p class="text-gray-600">Ya, semua produk kami memiliki garansi resmi selama 1 tahun untuk kerusakan produksi.</p>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition font-medium text-left focus:outline-none" aria-expanded="false">
                        <span>Berapa lama waktu pengiriman?</span>
                        <i class="fas fa-chevron-down text-gray-500 transform transition-transform"></i>
                    </button>
                    <div class="faq-answer p-4 border-t border-gray-200 hidden">
                        <p class="text-gray-600">Waktu pengiriman bervariasi tergantung lokasi Anda. Untuk area Jabodetabek biasanya 1-2 hari, untuk luar Jawa 3-5 hari kerja.</p>
                    </div>
                </div>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <button class="faq-question w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100 transition font-medium text-left focus:outline-none" aria-expanded="false">
                        <span>Bagaimana cara melakukan pengembalian produk?</span>
                        <i class="fas fa-chevron-down text-gray-500 transform transition-transform"></i>
                    </button>
                    <div class="faq-answer p-4 border-t border-gray-200 hidden">
                        <p class="text-gray-600">Untuk pengembalian produk, silakan hubungi customer service kami melalui email atau WhatsApp dalam waktu 7 hari setelah produk diterima.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-th-large mr-2 text-blue-500"></i>
                Produk Terkait
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="product-card bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 hover:shadow-md transition-shadow duration-300">
                    <a href="{{ route('shop.products.show', $relatedProduct->id) }}" class="block">
                        <div class="relative">
                            @if($relatedProduct->image)
                            <img src="{{ asset($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}"
                                 class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-3xl"></i>
                            </div>
                            @endif

                            <!-- Sale badge (simulated) -->
                            @if($loop->first)
                            <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                SALE 15%
                            </div>
                            @endif

                            <!-- Quick view button -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <button class="bg-white text-gray-800 hover:bg-gray-100 font-medium py-2 px-4 rounded-lg text-sm transition flex items-center">
                                    <i class="fas fa-eye mr-1"></i> Lihat Cepat
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-1">
                                <div class="text-sm text-blue-600">{{ $relatedProduct->category->name ?? 'Uncategorized' }}</div>
                                <!-- Rating -->
                                <div class="flex text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <h3 class="text-gray-800 font-medium text-lg hover:text-blue-600 transition line-clamp-2 h-14">{{ $relatedProduct->name }}</h3>
                            <div class="mt-2 flex items-center justify-between">
                                <div class="text-lg font-bold text-blue-600">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</div>
                                @if($relatedProduct->stock > 0)
                                <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">Tersedia</span>
                                @else
                                <span class="text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full">Habis</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-6">
                <a href="{{ route('shop.products.index') }}" class="inline-flex items-center px-6 py-3 border border-blue-300 text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 transition">
                    Lihat Semua Produk <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
        @endif

        <!-- Notify me modal (initially hidden) -->
        <div id="notify-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 mx-4 animate__animated animate__fadeInUp">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Dapatkan Notifikasi Stok</h3>
                    <button id="close-notify-modal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-gray-600 mb-4">Kami akan memberi tahu Anda saat produk ini tersedia kembali.</p>
                <form id="notify-form" class="space-y-4">
                    <div>
                        <label for="notify-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="notify-email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="email@example.com" required>
                    </div>
                    <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </main>

    <!-- Back to top button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-blue-600 text-white rounded-full p-3 shadow-lg opacity-0 hover:bg-blue-700 transition-opacity duration-300 focus:outline-none">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Quick view modal (simulated - would be populated with product data) -->
    <div id="quick-view-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full mx-4 animate__animated animate__fadeIn">
            <div class="flex justify-end p-4">
                <button id="close-quick-view" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <div class="bg-gray-100 rounded-lg p-2">
                        <img src="{{ asset($product->image ?? 'images/placeholder.jpg') }}" alt="Quick view product" class="w-full h-auto">
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Product Name</h3>
                    <div class="flex items-center mt-2">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="ml-1 text-gray-600 text-sm">(24 reviews)</span>
                    </div>
                    <div class="mt-4 text-2xl font-bold text-blue-600">
                        Rp 299.000
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum condimentum, nisl eu tincidunt faucibus, nulla urna facilisis magna, et ultrices nisl magna nec orci.
                        </p>
                    </div>
                    <div class="mt-6">
                        <button type="button" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Lihat Detail Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.11.2/toastify.min.js"></script>
    <script>
        // Pass product data to JavaScript
        const productData = {
            price: {{ $product->price ?? 0 }},
            stock: {{ $product->stock ?? 0 }}
        };

        // Pass shipping methods to JavaScript
        const shippingMethods = @json($shippingMethods ?? []);
    </script>
    <script src="{{ asset('js/shop.js') }}"></script>
</body>
</html>
