<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="ZiyadBooks - Temukan buku favorit Anda dengan koleksi premium kami">
    <title>{{ isset($currentCategory) ? $currentCategory->name : 'Katalog Buku' }} | ZiyadBooks</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
</head>
<body>
    <header id="header">
        <div class="header-container container">
            <a href="/" class="logo">
                ZiyadBook
            </a>
            <div class="nav-links">
                <a href="{{ route('shop.products.index') }}" class="nav-link">Shop</a>
                <a href="#categories" class="nav-link">Categories</a>
                <a href="#products" class="nav-link">All Books</a>
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
            <a href="#categories" class="mobile-nav-link">Categories</a>
            <a href="#products" class="mobile-nav-link">All Books</a>
        </div>
    </div>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-grid">
                    <div class="hero-content">
                        <h2 class="hero-title">Find Your Perfect Book at ZiyadBook</h2>
                        <p class="hero-subtitle">Discover a vast collection of books across various genres. Quality books at affordable prices.</p>
                        <div class="hero-buttons">
                            <a href="#products" class="btn btn-primary">Shop Now</a>
                            <a href="#categories" class="btn btn-secondary">Browse Categories</a>
                        </div>
                    </div>
                    <div class="hero-image">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Stack of books">
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Books Section -->
        <section class="section section-dark">
            <div class="container">
                <h2 class="section-title">Featured Books</h2>

                <div class="books-grid">
                    @foreach($featuredProducts as $product)
                    <div class="book-card">
                        <a href="{{ route('shop.products.show', $product->id) }}" class="book-image">
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #cbd5e0;">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            @endif
                        </a>
                        <div class="book-content">
                            <div class="book-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <h3 class="book-title">{{ $product->name }}</h3>
                            <p class="book-description">
                                {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                            </p>
                            <div class="book-footer">
                                <span class="book-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('shop.products.show', $product->id) }}" class="btn btn-sm btn-secondary">
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
        <section id="categories" class="section section-light">
            <div class="container">
                <h2 class="section-title">Browse Categories</h2>

                <div class="categories-grid">
                    @foreach($categories as $category)
                    <a href="{{ route('shop.products.category', $category->id) }}" class="category-card">
                        <div class="category-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="category-name">{{ $category->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- All Products Section -->
        <section id="products" class="section section-dark">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">
                        {{ isset($currentCategory) ? $currentCategory->name : 'All Books' }}
                    </h2>

                    @if(isset($currentCategory))
                    <a href="{{ route('shop.products.index') }}" class="back-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5"></path>
                            <path d="M12 19l-7-7 7-7"></path>
                        </svg>
                        Back to All Books
                    </a>
                    @endif
                </div>

                @if(session('error'))
                <div class="alert alert-error">
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                @if($products->isEmpty())
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="empty-text">No books available at the moment.</p>
                </div>
                @else
                <div class="books-grid">
                    @foreach($products as $product)
                    <div class="book-card">
                        <a href="{{ route('shop.products.show', $product->id) }}" class="book-image">
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #cbd5e0;">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            @endif
                        </a>
                        <div class="book-content">
                            <div class="book-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <h3 class="book-title">{{ $product->name }}</h3>
                            <p class="book-description">
                                {{ \Illuminate\Support\Str::limit($product->description, 60) }}
                            </p>
                            <div class="book-footer">
                                <span class="book-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <a href="{{ route('shop.products.show', $product->id) }}" class="btn btn-sm btn-secondary">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pagination">
                    {{ $products->links() }}
                </div>
                @endif
            </div>
        </section>
    </main>

    <script src="{{ asset('js/shop.js') }}"></script>
</body>
</html>
