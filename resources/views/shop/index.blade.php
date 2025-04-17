<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($currentCategory) ? $currentCategory->name : 'Katalog Produk' }}</title>
    <meta name="description" content="Temukan produk berkualitas dengan harga terbaik">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/shop.css')}}" rel="stylesheet">
    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .category-item {
            transition: all 0.2s ease;
        }
        .category-item:hover {
            transform: translateX(5px);
        }
        .search-box {
            transition: width 0.3s ease;
        }
        .search-box:focus {
            width: 100%;
        }
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/api/placeholder/1200/400');
            background-size: cover;
            background-position: center;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 50;
            border-radius: 0.375rem;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .quick-view-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
            justify-content: center;
            align-items: center;
        }
        .quick-view-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            z-index: 99;
        }
        .cart-bubble {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #EF4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Notification Bar -->
    <div class="bg-blue-600 text-white py-2 px-4 text-center" id="promo-banner">
        <p class="text-sm">Promo Spesial! Gratis Ongkir untuk pembelian minimal Rp 200.000 <button class="ml-2 text-xs" onclick="document.getElementById('promo-banner').style.display='none'"><i class="fas fa-times"></i></button></p>
    </div>

    <header class="bg-white shadow sticky top-0 z-40">
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

                    <div class="dropdown">
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition">
                            <i class="fas fa-th-large mr-1"></i> Kategori
                        </a>
                        <div class="dropdown-content pt-2">
                            <a href="{{ route('shop.products.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Semua Kategori</a>
                            @foreach($categories as $category)
                            <a href="{{ route('shop.products.category', $category->id) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <a href="https://api.whatsapp.com/send/?phone=6282243431114&text=Hai+Kak%2C+saya+ingin+bertanya+tentang+produk"
                        target="_blank"
                        class="text-gray-600 hover:text-blue-600 transition">
                        <i class="fab fa-whatsapp mr-1"></i> Kontak
                    </a>

                    <a href="#" class="cart-bubble text-gray-600 hover:text-blue-600 transition" id="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" id="cart-count">0</span>
                    </a>
                </nav>
            </div>

            <!-- Mobile Search Bar -->
            <div class="md:hidden mt-4">
                <form action="{{ route('shop.products.index') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Cari produk..."
                        class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="absolute right-3 top-2 text-gray-500">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="hero-section py-12 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Temukan Produk Berkualitas</h2>
            <p class="text-white text-lg mb-6">Dapatkan produk terbaik dengan harga terjangkau</p>
            <a href="#product-section" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition">
                Belanja Sekarang
            </a>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-6" id="product-section">
            <!-- Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white p-4 rounded-lg shadow mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Kategori</h2>
                    <ul class="space-y-1">
                        <li class="category-item">
                            <a href="{{ route('shop.products.index') }}"
                               class="block px-3 py-2 rounded {{ !isset($currentCategory) ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                <i class="fas fa-th-large mr-2"></i> Semua Kategori
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li class="category-item">
                            <a href="{{ route('shop.products.category', $category->id) }}"
                               class="block px-3 py-2 rounded {{ isset($currentCategory) && $currentCategory->id == $category->id ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                <i class="fas fa-tag mr-2"></i> {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Filter Section -->
                <div class="bg-white p-4 rounded-lg shadow mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Filter</h2>
                    <form id="filter-form">
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Harga</label>
                            <div class="flex items-center space-x-2">
                                <input type="text" placeholder="Min" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <span>-</span>
                                <input type="text" placeholder="Max" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Urutkan</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md" id="sort-select">
                                <option value="newest">Terbaru</option>
                                <option value="price_asc">Harga: Rendah ke Tinggi</option>
                                <option value="price_desc">Harga: Tinggi ke Rendah</option>
                                <option value="name_asc">Nama: A-Z</option>
                                <option value="name_desc">Nama: Z-A</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                            Terapkan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="w-full md:w-3/4">
                <div class="bg-white p-4 rounded-lg shadow mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ isset($currentCategory) ? $currentCategory->name : 'Semua Produk' }}
                        </h2>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-gray-500 hover:text-blue-500 view-toggle" data-view="grid">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="p-2 text-gray-500 hover:text-blue-500 view-toggle" data-view="list">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>

                    @if($products->isEmpty())
                    <div class="text-center py-8">
                        <div class="text-gray-400 text-5xl mb-4">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <p class="text-gray-500">Tidak ada produk yang tersedia saat ini.</p>
                    </div>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="products-container">
                        @foreach($products as $product)
                        <div class="product-card bg-white rounded-lg shadow overflow-hidden border border-gray-200">
                            <a href="{{ route('shop.products.show', $product->id) }}">
                                @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover">
                                @else
                                <img src="/api/placeholder/300/200" alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover">
                                @endif
                            </a>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                                    <button class="text-gray-400 hover:text-red-500 transition" onclick="toggleWishlist(this, {{ $product->id }})">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                                <div class="text-sm text-gray-500 mb-2">{{ $product->category->name ?? 'Uncategorized' }}</div>
                                <div class="text-lg font-bold text-gray-900 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-500">
                                        <span class="{{ $product->stock > 0 ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Stok Habis' }}
                                        </span>
                                    </div>
                                    <button class="text-blue-500 hover:text-blue-700 text-sm font-medium" onclick="showQuickView({{ $product->id }})">
                                        Quick View
                                    </button>
                                </div>
                            </div>
                            <div class="px-4 pb-4 flex space-x-2">
                                <a href="{{ route('shop.products.show', $product->id) }}"
                                   class="block w-1/2 py-2 px-2 bg-blue-500 text-white text-center rounded hover:bg-blue-600 transition">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})"
                                   class="block w-1/2 py-2 px-2 bg-green-500 text-white text-center rounded hover:bg-green-600 transition {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                   {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-cart-plus"></i> Keranjang
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Quick View Modal -->
    <div class="quick-view-modal" id="quick-view-modal">
        <div class="quick-view-content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold" id="quick-view-title">Detail Produk</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeQuickView()">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex flex-col md:flex-row gap-6" id="quick-view-content">
                <div class="w-full md:w-1/2">
                    <img src="/api/placeholder/400/300" alt="Product" id="quick-view-image" class="w-full h-auto rounded">
                </div>
                <div class="w-full md:w-1/2">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2" id="quick-view-name">Nama Produk</h4>
                    <div class="text-sm text-gray-500 mb-2" id="quick-view-category">Kategori</div>
                    <div class="text-2xl font-bold text-gray-900 mb-4" id="quick-view-price">Rp 0</div>
                    <div class="text-sm text-gray-700 mb-4" id="quick-view-description">
                        Deskripsi produk...
                    </div>
                    <div class="mb-4">
                        <div class="text-sm text-gray-500 mb-2">Jumlah:</div>
                        <div class="flex items-center">
                            <button class="px-3 py-1 border border-gray-300 rounded-l" onclick="decrementQuantity()">-</button>
                            <input type="number" value="1" min="1" class="w-16 text-center py-1 border-t border-b border-gray-300" id="quantity-input">
                            <button class="px-3 py-1 border border-gray-300 rounded-r" onclick="incrementQuantity()">+</button>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button class="w-1/2 py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition" onclick="addToCartFromQuickView()">
                            <i class="fas fa-cart-plus mr-2"></i> Tambah ke Keranjang
                        </button>
                        <a href="{{ route('shop.products.show', $product->id) }}" id="quick-view-detail-link" class="w-1/2 py-2 px-4 bg-gray-800 text-white text-center rounded hover:bg-gray-900 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shopping Cart Sidebar -->
    <div class="fixed inset-y-0 right-0 w-full md:w-80 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50" id="cart-sidebar">
        <div class="flex flex-col h-full">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold">Keranjang Belanja</h3>
                <button class="text-gray-500 hover:text-gray-700" onclick="toggleCart()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex-grow overflow-y-auto p-4" id="cart-items">
                <div class="text-center text-gray-500 py-10">
                    Keranjang belanja Anda kosong.
                </div>
            </div>
            <div class="p-4 border-t">
                <div class="flex justify-between mb-4">
                    <span class="font-semibold">Total:</span>
                    <span class="font-bold" id="cart-total">Rp 0</span>
                </div>
                <button class="w-full py-2 bg-green-500 text-white rounded hover:bg-green-600 transition mb-2">
                    Checkout
                </button>
                <button class="w-full py-2 bg-red-500 text-white rounded hover:bg-red-600 transition" onclick="clearCart()">
                    Kosongkan Keranjang
                </button>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top bg-blue-500 hover:bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="{{asset('js/shop.js')}}"></script>
    <script>
        // Cart functionality
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let currentProductId = null;

        function updateCartCount() {
            const count = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cart-count').innerText = count;
        }

        function updateCartDisplay() {
            const cartItemsContainer = document.getElementById('cart-items');
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="text-center text-gray-500 py-10">
                        Keranjang belanja Anda kosong.
                    </div>
                `;
            } else {
                cartItemsContainer.innerHTML = cart.map(item => `
                    <div class="flex items-center mb-4 pb-4 border-b">
                        <div class="w-16 h-16 bg-gray-200 rounded mr-4"></div>
                        <div class="flex-grow">
                            <h4 class="text-sm font-medium">${item.name}</h4>
                            <div class="text-sm text-gray-500">Rp ${numberFormat(item.price)} x ${item.quantity}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-medium">Rp ${numberFormat(item.price * item.quantity)}</div>
                            <button class="text-red-500 text-xs mt-1" onclick="removeFromCart(${item.id})">Hapus</button>
                        </div>
                    </div>
                `).join('');
            }

            document.getElementById('cart-total').innerText = `Rp ${numberFormat(total)}`;
        }

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateCartDisplay();

            // Show notification
            showNotification(`${name} ditambahkan ke keranjang!`);

            // Open cart sidebar
            toggleCart(true);
        }

        function addToCartFromQuickView() {
            if (currentProductId) {
                const quantity = parseInt(document.getElementById('quantity-input').value);
                const name = document.getElementById('quick-view-name').innerText;
                const priceText = document.getElementById('quick-view-price').innerText;
                const price = parseInt(priceText.replace(/[^0-9]/g, ''));

                const existingItem = cart.find(item => item.id === currentProductId);

                if (existingItem) {
                    existingItem.quantity += quantity;
                } else {
                    cart.push({ id: currentProductId, name, price, quantity });
                }

                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartCount();
                updateCartDisplay();

                // Show notification
                showNotification(`${name} ditambahkan ke keranjang!`);

                // Close quick view and open cart
                closeQuickView();
                toggleCart(true);
            }
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateCartDisplay();
        }

        function clearCart() {
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            updateCartDisplay();
            showNotification('Keranjang berhasil dikosongkan!');
        }

        function toggleCart(forceOpen = false) {
            const cartSidebar = document.getElementById('cart-sidebar');
            const isOpen = cartSidebar.classList.contains('translate-x-0');

            if (forceOpen && !isOpen) {
                cartSidebar.classList.remove('translate-x-full');
                cartSidebar.classList.add('translate-x-0');
            } else if (!forceOpen) {
                cartSidebar.classList.toggle('translate-x-full');
                cartSidebar.classList.toggle('translate-x-0');
            }
        }

        // Quick View functionality
        function showQuickView(productId) {
            currentProductId = productId;
            // In a real app, you would fetch product details from the server
            // For now, let's simulate with dummy data
            document.getElementById('quick-view-name').innerText = 'Produk #' + productId;
            document.getElementById('quick-view-category').innerText = 'Kategori Contoh';
            document.getElementById('quick-view-price').innerText = 'Rp 199.000';
            document.getElementById('quick-view-description').innerText = 'Deskripsi produk ini akan ditampilkan di sini. Produk ini memiliki kualitas terbaik dan sangat cocok untuk kebutuhan Anda.';
            document.getElementById('quick-view-detail-link').href = '/produk/' + productId;
            document.getElementById('quantity-input').value = 1;

            const modal = document.getElementById('quick-view-modal');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeQuickView() {
            const modal = document.getElementById('quick-view-modal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Enable scrolling
        }

        function incrementQuantity() {
            const input = document.getElementById('quantity-input');
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity() {
            const input = document.getElementById('quantity-input');
            const value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        // Toggle view (grid/list)
        document.querySelectorAll('.view-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const view = this.getAttribute('data-view');
                const container = document.getElementById('products-container');

                if (view === 'grid') {
                    container.classList.remove('grid-cols-1');
                    container.classList.add('grid-cols-1', 'sm:grid-cols-2', 'lg:grid-cols-3');
                } else {
                    container.classList.remove('sm:grid-cols-2', 'lg:grid-cols-3');
                    container.classList.add('grid-cols-1');

                    // Adjust the layout for list view
                    document.querySelectorAll('.product-card').forEach(card => {
                        // This would typically modify the card's layout for list view
                        // For simplicity, we're not implementing the full transformation here
                    });
                }

                // Highlight active button
                document.querySelectorAll('.view-toggle').forEach(btn => {
                    btn.classList.remove('text-blue-500');
                    btn.classList.add('text-gray-500');
                });
                this.classList.remove('text-gray-500');
                this.classList.add('text-blue-500');
            });
        });

        // Back to top functionality
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) { // Show button after scrolling down 300px
                backToTopButton.style.display = 'flex';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Notification functionality
        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg';
            notification.style.zIndex = '9999';
            notification.textContent = message;

            // Add to body
            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('opacity-0');
                notification.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 500);
            }, 3000);
        }

        // Wishlist functionality
        function toggleWishlist(button, productId) {
            const icon = button.querySelector('i');

            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.parentElement.classList.add('text-red-500');
                showNotification('Produk ditambahkan ke wishlist!');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.parentElement.classList.remove('text-red-500');
                showNotification('Produk dihapus dari wishlist!');
            }
        }

        // Filter form handling
        document.getElementById('filter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            showNotification('Filter diterapkan!');
            // In a real app, this would submit the form or use AJAX to filter products
        });

        // Sort select handling
        document.getElementById('sort-select').addEventListener('change', function() {
            showNotification('Produk diurutkan berdasarkan: ' + this.options[this.selectedIndex].text);
            // In a real app, this would trigger sorting of products
        });

        // Helper functions
        function numberFormat(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize cart display
            updateCartCount();
            updateCartDisplay();

            // Setup cart toggle
            document.getElementById('cart-icon').addEventListener('click', function(e) {
                e.preventDefault();
                toggleCart();
            });

            // Close quick view when clicking outside the content
            document.getElementById('quick-view-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeQuickView();
                }
            });

            // Add smooth scrolling to all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Initialize any sliders or carousels here

            // Add animation to product cards on scroll
            const productCards = document.querySelectorAll('.product-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.transform = 'translateY(0)';
                        entry.target.style.opacity = '1';
                    }
                });
            });

            productCards.forEach(card => {
                card.style.transform = 'translateY(20px)';
                card.style.opacity = '0';
                card.style.transition = 'transform 0.5s ease, opacity 0.5s ease';
                observer.observe(card);
            });
        });
    </script>
