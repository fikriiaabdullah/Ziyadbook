<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($currentCategory) ? $currentCategory->name : 'Katalog Buku' }} | ZiyadBook</title>
    <meta name="description" content="Temukan koleksi buku berkualitas dengan harga terbaik">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
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

    <main>
        <!-- Hero Section -->
        <section class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Find Your Perfect Book<br>at ZiyadBook
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Discover a vast collection of books across various genres. Quality books at affordable prices.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#products" class="btn-primary">
                                Shop Now
                            </a>
                            <a href="#categories" class="btn-outline">
                                Categories
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                             alt="Stack of books"
                             class="rounded-lg shadow-lg max-w-full h-auto">
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Books Section -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Featured Books</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow">
                        <a href="{{ route('shop.products.show', $product->id) }}">
                            <div class="h-48 overflow-hidden">
                                @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
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
                            <div class="text-xs text-blue-600 mb-1">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <h3 class="font-medium text-gray-900 mb-2 line-clamp-2 h-12">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2 h-10">
                                {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('shop.products.show', $product->id) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Browse Categories -->
        <section id="categories" class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Browse Categories</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($categories as $category)
                    <a href="{{ route('shop.products.category', $category->id) }}"
                       class="category-card flex flex-col items-center p-6 border border-gray-200 rounded-lg">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="text-gray-900 font-medium">{{ $category->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- All Products Section -->
        <section id="products" class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ isset($currentCategory) ? $currentCategory->name : 'All Books' }}
                    </h2>

                    @if(isset($currentCategory))
                    <a href="{{ route('shop.products.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to All Books
                    </a>
                    @endif
                </div>

                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                @if($products->isEmpty())
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-600">No books available at the moment.</p>
                </div>
                @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <div class="book-card bg-white rounded-lg overflow-hidden shadow">
                        <a href="{{ route('shop.products.show', $product->id) }}">
                            <div class="h-48 overflow-hidden">
                                @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
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
                            <div class="text-xs text-blue-600 mb-1">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <h3 class="font-medium text-gray-900 mb-2 line-clamp-2 h-12">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2 h-10">
                                {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('shop.products.show', $product->id) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </section>
    </main>

    <script src="{{ asset('js/shop.js') }}"></script>
</body>
</html>
