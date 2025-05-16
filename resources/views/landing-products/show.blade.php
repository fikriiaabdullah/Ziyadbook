@php
    if (!isset($product) && isset($landingProduct)) {
        $product = $landingProduct->product;
    }

    // Fix variable name consistency
    $landingPage = $landingProduct ?? null;

    // Get related products if not already set
    if (!isset($relatedProducts) && isset($product)) {
        $relatedProducts = \App\Models\Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();
    } else {
        $relatedProducts = collect();
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $landingPage->headline ?? $product->name }} | ZiyadBook</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit($landingPage->problem ?? $product->description, 160) }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <style>
        .highlight-box {
            background-color: #f8fafc;
            border-left: 4px solid #4f46e5;
            padding: 1rem;
            margin: 1.5rem 0;
            border-radius: 0.375rem;
        }
        .benefit-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        .benefit-icon {
            flex-shrink: 0;
            margin-right: 0.75rem;
            color: #4f46e5;
        }
        .testimonial-card {
            background-color: #f8fafc;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .quote-mark {
            font-size: 3rem;
            line-height: 1;
            color: #e5e7eb;
            font-family: serif;
            margin-bottom: -1.5rem;
        }
        /* Video responsive container */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 0.5rem;
        }
        /* Image gallery styles */
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.5rem;
            font-size: 0.875rem;
        }
        /* Lightbox styles */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
        }
        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
        }
        .lightbox-image {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
        }
        .lightbox-caption {
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 1rem;
        }
        .lightbox-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: white;
            font-size: 2rem;
            cursor: pointer;
        }
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 2rem;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.5);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .lightbox-prev {
            left: 1rem;
        }
        .lightbox-next {
            right: 1rem;
        }
    </style>

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
<body class="bg-gray-50">
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
            <!-- Breadcrumbs -->
            <nav class="mb-4 text-sm">
                <ol class="flex flex-wrap items-center space-x-2">
                    <li><a href="{{ route('shop.products.index') }}" class="text-indigo-600 hover:text-indigo-800 transition">Home</a></li>
                    <li><span class="text-gray-500 mx-2">/</span></li>
                    @if($product->category)
                    <li><a href="{{ route('shop.products.category', $product->category->id) }}" class="text-indigo-600 hover:text-indigo-800 transition">{{ $product->category->name }}</a></li>
                    <li><span class="text-gray-500 mx-2">/</span></li>
                    @endif
                    <li class="text-gray-700 font-medium truncate max-w-xs">{{ $product->name }}</li>
                </ol>
            </nav>

            <!-- Hero Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="p-6 md:p-8 lg:p-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <div>
                            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                                {{ $landingPage->headline ?? $product->name }}
                            </h1>

                            @if($landingPage && $landingPage->subheadline)
                            <p class="text-xl text-gray-600 mb-6">{{ $landingPage->subheadline }}</p>
                            @endif

                            <div class="flex items-center mb-6">
                                <div class="text-3xl font-bold text-indigo-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>

                                @if($product->stock > 0)
                                    @if($product->stock <= 5)
                                    <span class="ml-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Limited Stock ({{ $product->stock }} left)
                                    </span>
                                    @else
                                    <span class="ml-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        In Stock
                                    </span>
                                    @endif
                                @else
                                    <span class="ml-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Out of Stock
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="flex justify-center">
                            <div class="relative rounded-lg overflow-hidden border border-gray-200 shadow-lg max-w-md">
                                @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-contain">
                                @else
                                <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                @endif

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
                    </div>
                </div>
            </div>

            <!-- Image Gallery Section -->
            @if($landingPage && $landingPage->images->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Product Gallery</h2>
                    <div class="image-carousel relative">
                        <!-- Main carousel container -->
                        <div class="carousel-container h-80 relative overflow-hidden">
                            @foreach($landingPage->images as $index => $image)
                            <div class="carousel-item absolute top-0 left-0 w-full h-full transition-opacity duration-300 ease-in-out opacity-0 flex justify-center items-center" data-index="{{ $index }}">
                                <img src="{{ asset($image->image_path) }}" alt="{{ $image->caption ?? $product->name }}" loading="lazy" class="max-h-full max-w-full object-contain">
                                @if($image->caption)
                                <div class="carousel-caption absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-3 text-center">
                                    {{ $image->caption }}
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <!-- Navigation arrows -->
                        <button class="carousel-nav-left absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-60 text-white p-4 rounded-r-lg opacity-0 transition-opacity duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="carousel-nav-right absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-60 text-white p-4 rounded-l-lg opacity-0 transition-opacity duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <!-- Indicator dots (optional) -->
                        <div class="carousel-indicators flex justify-center gap-2 mt-4">
                            @foreach($landingPage->images as $index => $image)
                            <button class="carousel-indicator w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-500 transition-colors duration-200" data-index="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- YouTube Video Section -->
            @if($landingPage && $landingPage->youtube_video_url)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Watch Our Video</h2>
                    <div class="video-container">
                        @php
                            // Extract video ID from YouTube URL
                            $videoId = '';
                            $url = $landingPage->youtube_video_url;

                            if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
                                $videoId = $matches[1];
                            } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $matches)) {
                                $videoId = $matches[1];
                            } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
                                $videoId = $matches[1];
                            }
                        @endphp

                        @if($videoId)
                        <iframe
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            title="{{ $product->name }} Video"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <div class="max-w-8xl mx-auto mb-8 bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Main container with flex layout -->
                <div class="flex flex-col md:flex-row items-center justify-between p-6">
                    <!-- First image with caption -->
                    <div class="mb-6 md:mb-0 md:w-1/3 flex flex-col items-center">
                        <img src="{{ asset('images/mba-1.png') }}" alt="MBA 1" class="w-full h-auto rounded-lg shadow-sm mb-2">
                        <p class="text-sm text-center text-gray-600">✨ Dapatkan Sekarang & Hadirkan Anak Anda Nilai Terbaik! ✨</p>
                    </div>

                    <!-- Middle section with Cart Icon -->
                    <div class="py-4 md:w-1/3 flex flex-col items-center justify-center px-4">
                        <a href="#call-to-action" class="text-indigo-600 hover:text-indigo-800 transition transform hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Second image with question mark -->
                    <div class="md:w-1/3 flex flex-col items-center">
                        <div class="relative">
                            <img src="{{ asset('images/mba-2.png') }}" alt="MBA 2" class="w-full h-auto rounded-lg shadow-sm">
                        </div>
                        <p class="text-sm text-center text-gray-600 mt-2">Have questions? We're here to help!</p>
                    </div>
                </div>
            </div>

            <!-- PAS Framework Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Problem Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h2 class="text-xl font-bold text-gray-900">The Problem</h2>
                        </div>
                        <div class="prose prose-indigo">
                            {!! nl2br(e($landingPage->problem ?? 'Are you struggling with this problem? Many people face this challenge every day.')) !!}
                        </div>
                    </div>
                </div>

                <!-- Agitate Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h2 class="text-xl font-bold text-gray-900">Why It Matters</h2>
                        </div>
                        <div class="prose prose-indigo">
                            {!! nl2br(e($landingPage->agitate ?? 'Without addressing this issue, you might continue to experience these challenges and frustrations.')) !!}
                        </div>
                    </div>
                </div>

                <!-- Solution Section -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h2 class="text-xl font-bold text-gray-900">The Solution</h2>
                        </div>
                        <div class="prose prose-indigo">
                            {!! nl2br(e($landingPage->solution ?? 'Our product provides the perfect solution to help you overcome these challenges.')) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            @if($landingPage && $landingPage->benefits)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-12">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Key Benefits</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(explode("\n", $landingPage->benefits) as $benefit)
                            @if(trim($benefit))
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>{{ trim($benefit) }}</div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Testimonials Section -->
            @if($landingPage && $landingPage->testimonials)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-12">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">What Our Customers Say</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(explode("\n", $landingPage->testimonials) as $testimonial)
                            @if(trim($testimonial))
                                @php
                                    $parts = explode('|', trim($testimonial));
                                    $name = $parts[0] ?? 'Customer';
                                    $position = $parts[1] ?? '';
                                    $quote = $parts[2] ?? $parts[0];
                                @endphp
                                <div class="testimonial-card">
                                    <div class="quote-mark">"</div>
                                    <p class="text-gray-700 mb-4">{{ $quote }}</p>
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-bold">
                                            {{ substr($name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $name }}</p>
                                            @if($position)
                                            <p class="text-sm text-gray-500">{{ $position }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Call to Action -->
            <div id="call-to-action" class="bg-indigo-500 rounded-lg shadow-xl overflow-hidden mb-12">
                <div class="p-6 md:p-8 text-center">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Ready to Solve Your Problem?</h2>
                    <p class="text-indigo-100 mb-6 max-w-2xl mx-auto">Don't wait any longer. Get your copy of {{ $product->name }} today and start experiencing the benefits.</p>
                    <a href="{{ route('shop.products.show', $product->id) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 md:py-4 md:text-lg md:px-8 transition transform hover:scale-105 shadow-lg">
                        {{ $landingPage->call_to_action ?? 'Buy Now' }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                    </a>
                </div>
            </div>

            <!-- Related Products -->
            @if(count($relatedProducts) > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">You May Also Like</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition">
                            <a href="{{ route('shop.products.show', $relatedProduct->id) }}" class="block">
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
                                <div class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $relatedProduct->name }}</h3>
                                    <p class="text-indigo-600 font-bold">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm text-gray-500">&copy; {{ date('Y') }} ZiyadBook. All rights reserved.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="https://www.facebook.com/ziyadbooks.official/" class="text-gray-500 hover:text-gray-700">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/ziyadbooks.official/" class="text-gray-500 hover:text-gray-700">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="https://twitter.com/ziyadbooks?lang=ca" class="text-gray-500 hover:text-gray-700">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Lightbox for image gallery -->
    <div id="lightbox" class="lightbox">
        <span class="lightbox-close">&times;</span>
        <div class="lightbox-content">
            <img id="lightbox-image" class="lightbox-image" src="/placeholder.svg" alt="">
            <div id="lightbox-caption" class="lightbox-caption"></div>
        </div>
        <span class="lightbox-nav lightbox-prev">&lt;</span>
        <span class="lightbox-nav lightbox-next">&gt;</span>
    </div>

    <script src="{{ asset('js/shop.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image carousel functionality
            const carousel = document.querySelector('.image-carousel');
            if (carousel) {
                const carouselItems = carousel.querySelectorAll('.carousel-item');
                const navLeft = carousel.querySelector('.carousel-nav-left');
                const navRight = carousel.querySelector('.carousel-nav-right');
                const indicators = carousel.querySelectorAll('.carousel-indicator');
                const container = carousel.querySelector('.carousel-container');

                let carouselIndex = 0;
                const totalCarouselItems = carouselItems.length;

                // Initialize: show first item
                if (carouselItems.length > 0) {
                    carouselItems[0].classList.add('opacity-100');
                    if (indicators.length > 0) {
                        indicators[0].classList.remove('bg-gray-300');
                        indicators[0].classList.add('bg-gray-700');
                    }
                }

                // Function to move to a specific slide
                function goToSlide(index) {
                    if (index < 0) index = totalCarouselItems - 1;
                    if (index >= totalCarouselItems) index = 0;

                    // Hide all items and update indicators
                    carouselItems.forEach((item, i) => {
                        item.classList.remove('opacity-100');
                        if (indicators.length > i) {
                            indicators[i].classList.remove('bg-gray-700');
                            indicators[i].classList.add('bg-gray-300');
                        }
                    });

                    // Show selected item and update its indicator
                    carouselItems[index].classList.add('opacity-100');
                    if (indicators.length > index) {
                        indicators[index].classList.remove('bg-gray-300');
                        indicators[index].classList.add('bg-gray-700');
                    }

                    carouselIndex = index;
                }

                // Navigation event listeners
                if (navLeft) navLeft.addEventListener('click', () => goToSlide(carouselIndex - 1));
                if (navRight) navRight.addEventListener('click', () => goToSlide(carouselIndex + 1));

                // Hover effects for navigation
                container.addEventListener('mouseenter', () => {
                    if (navLeft) {
                        navLeft.classList.remove('opacity-0');
                        navLeft.classList.add('opacity-100');
                    }
                    if (navRight) {
                        navRight.classList.remove('opacity-0');
                        navRight.classList.add('opacity-100');
                    }
                });

                container.addEventListener('mouseleave', () => {
                    if (navLeft) {
                        navLeft.classList.remove('opacity-100');
                        navLeft.classList.add('opacity-0');
                    }
                    if (navRight) {
                        navRight.classList.remove('opacity-100');
                        navRight.classList.add('opacity-0');
                    }
                });

                // Setup indicator clicks
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => goToSlide(index));
                });

                // Enable hover navigation to left/right areas
                const leftZone = document.createElement('div');
                leftZone.className = 'absolute left-0 top-0 h-full w-1/5 z-10';

                const rightZone = document.createElement('div');
                rightZone.className = 'absolute right-0 top-0 h-full w-1/5 z-10';

                container.appendChild(leftZone);
                container.appendChild(rightZone);

                leftZone.addEventListener('mouseenter', () => {
                    if (navLeft) {
                        navLeft.classList.remove('opacity-0');
                        navLeft.classList.add('opacity-100');
                    }
                });

                rightZone.addEventListener('mouseenter', () => {
                    if (navRight) {
                        navRight.classList.remove('opacity-0');
                        navRight.classList.add('opacity-100');
                    }
                });

                // On hover, navigate to previous/next image
                leftZone.addEventListener('click', () => goToSlide(carouselIndex - 1));
                rightZone.addEventListener('click', () => goToSlide(carouselIndex + 1));

                // Make carousel items clickable to open lightbox
                carouselItems.forEach((item, index) => {
                    item.addEventListener('click', function() {
                        if (typeof openLightbox === 'function') {
                            openLightbox(index);
                        }
                    });
                });
            }

            // Image gallery lightbox functionality
            const galleryItems = document.querySelectorAll('.gallery-item');
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxCaption = document.getElementById('lightbox-caption');
            const lightboxClose = document.querySelector('.lightbox-close');
            const lightboxPrev = document.querySelector('.lightbox-prev');
            const lightboxNext = document.querySelector('.lightbox-next');
            let currentIndex = 0;

            // Get all displayable items (either gallery items or carousel items)
            const allItems = galleryItems.length > 0 ?
                            galleryItems :
                            document.querySelectorAll('.carousel-item');

            if (allItems.length > 0 && lightbox) {
                // Open lightbox when clicking on a gallery item
                allItems.forEach(item => {
                    if (!item.hasAttribute('data-lightbox-enabled')) {
                        item.setAttribute('data-lightbox-enabled', 'true');
                        item.addEventListener('click', function() {
                            currentIndex = parseInt(this.dataset.index);
                            openLightbox(currentIndex);
                        });
                    }
                });

                // Close lightbox
                if (lightboxClose) {
                    lightboxClose.addEventListener('click', function() {
                        lightbox.style.display = 'none';
                    });
                }

                // Navigate to previous image
                if (lightboxPrev) {
                    lightboxPrev.addEventListener('click', function() {
                        currentIndex = (currentIndex - 1 + allItems.length) % allItems.length;
                        openLightbox(currentIndex);
                    });
                }

                // Navigate to next image
                if (lightboxNext) {
                    lightboxNext.addEventListener('click', function() {
                        currentIndex = (currentIndex + 1) % allItems.length;
                        openLightbox(currentIndex);
                    });
                }

                // Close lightbox when clicking outside the image
                lightbox.addEventListener('click', function(e) {
                    if (e.target === lightbox) {
                        lightbox.style.display = 'none';
                    }
                });

                // Keyboard navigation
                document.addEventListener('keydown', function(e) {
                    if (lightbox.style.display === 'flex') {
                        if (e.key === 'Escape') {
                            lightbox.style.display = 'none';
                        } else if (e.key === 'ArrowLeft') {
                            currentIndex = (currentIndex - 1 + allItems.length) % allItems.length;
                            openLightbox(currentIndex);
                        } else if (e.key === 'ArrowRight') {
                            currentIndex = (currentIndex + 1) % allItems.length;
                            openLightbox(currentIndex);
                        }
                    }
                });
            }

            // Function to open lightbox with specific image
            function openLightbox(index) {
                // First try to get the item from gallery items
                let items = galleryItems.length > 0 ? galleryItems : document.querySelectorAll('.carousel-item');

                if (!lightbox || !lightboxImage || items.length === 0) return;

                const item = items[index];
                const img = item.querySelector('img');
                const caption = item.querySelector('.gallery-caption') || item.querySelector('.carousel-caption');

                if (img) {
                    lightboxImage.src = img.src;
                    lightboxImage.alt = img.alt;
                }

                if (lightboxCaption) {
                    if (caption) {
                        lightboxCaption.textContent = caption.textContent;
                        lightboxCaption.style.display = 'block';
                    } else {
                        lightboxCaption.style.display = 'none';
                    }
                }

                lightbox.style.display = 'flex';
            }
        });
    </script>
</body>
</html>
