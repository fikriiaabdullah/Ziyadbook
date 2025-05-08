<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="ZiyadBooks - Temukan buku favorit Anda dengan koleksi premium kami">
    <title>ZiyadBooks | Toko Buku Premium</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2c3e50;
            --primary-hover: #1a252f;
            --primary-light: #edf2f7;
            --secondary: #f8f9fa;
            --accent: #3498db;
            --accent-light: #ebf8ff;
            --text: #2d3748;
            --text-light: #718096;
            --background: #f7fafc;
            --card: #ffffff;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text);
            line-height: 1.7;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            position: relative;
        }

        /* Header */
        header {
            background-color: var(--card);
            box-shadow: var(--shadow-sm);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            transition: all 0.3s ease;
        }

        header.scrolled {
            box-shadow: var(--shadow);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            transition: padding 0.3s ease;
        }

        header.scrolled .header-container {
            padding: 0.75rem 1.5rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: translateY(-2px);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s;
            cursor: pointer;
            font-size: 1rem;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-secondary {
            background-color: var(--accent-light);
            color: var(--accent);
            border: 1px solid var(--accent-light);
        }

        .btn-secondary:hover {
            background-color: var(--accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }

        .mobile-menu-btn:hover {
            color: var(--accent);
        }

        /* Hero Section */
        .hero {
            padding: 8rem 0 4rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary-light) 0%, rgba(230, 240, 250, 0) 70%);
            z-index: -1;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -10%;
            left: -5%;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--accent-light) 0%, rgba(219, 234, 254, 0) 70%);
            z-index: -1;
        }

        .hero-container {
            display: flex;
            align-items: center;
            gap: 4rem;
        }

        .hero-content {
            flex: 1;
            animation: fadeInUp 1s ease-out;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--text);
            position: relative;
        }

        .hero-title::after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--primary));
            bottom: -0.5rem;
            left: 0;
            border-radius: 2px;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 2.5rem;
            font-weight: 500;
        }

        .search-container {
            position: relative;
            margin-bottom: 2.5rem;
            max-width: 500px;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1.5rem;
            padding-right: 3.5rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border);
            font-size: 1rem;
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .search-btn {
            position: absolute;
            right: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.2s;
        }

        .search-btn:hover {
            color: var(--accent);
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            animation: fadeIn 1s ease-out;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
        }

        /* Mobile menu */
        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--card);
            z-index: 200;
            padding: 2rem;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-nav.active {
            transform: translateX(0);
        }

        .mobile-nav-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .close-menu {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text);
            cursor: pointer;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .mobile-nav-link {
            color: var(--text);
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 500;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-container {
                flex-direction: column-reverse;
                gap: 3rem;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-image {
                max-width: 80%;
                margin: 0 auto;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .hero-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <div class="header-container container">
            <a href="/" class="logo">
                Ziyadbook
            </a>
            <div class="nav-links">
                <a href="{{route('shop.products.index')}}" class="nav-link">Shop</a>
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
                Beranda
            </a>
            <button class="close-menu" id="closeMenu" aria-label="Close mobile menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="mobile-nav-links">
            <a href="{{route('shop.products.index')}}" class="mobile-nav-link">Shop</a>
            <a href="{{ route('login') }}" class="mobile-nav-link">Masuk</a>
            <a href="{{ route('login') }}" class="mobile-nav-link">Masuk sebagai Admin</a>
        </div>
    </div>

    <section class="hero">
        <div class="container">
            <div class="hero-container">
                <div class="hero-content">
                    <h1 class="hero-title">Temukan<br>Buku<br>Favoritmu</h1>
                    <p class="hero-subtitle">Mulai Perjalanan Membaca Sekarang!</p>
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="Cari judul buku atau penulis..." aria-label="Search books">
                        <button class="search-btn" aria-label="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="hero-buttons">
                        <a href="{{ route('login') }}" class="btn btn-primary">Masuk sebagai Admin</a>
                        <a href="{{route('shop.products.index')}}" class="btn btn-secondary">Mulai Belanja</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/ChatGPT%20Image%20May%205%2C%202025%2C%2002_15_43%20PM-xBSZEJUH0nX3JHzpVDL2iArgw8Ha2x.png" alt="Ilustrasi orang membaca buku">
                </div>
            </div>
        </div>
    </section>

    <script>
        // Header scroll effect
        const header = document.getElementById('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileNav = document.getElementById('mobileNav');
        const closeMenu = document.getElementById('closeMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileNav.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeMenu.addEventListener('click', () => {
            mobileNav.classList.remove('active');
            document.body.style.overflow = 'auto';
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        const searchBtn = document.querySelector('.search-btn');

        searchBtn.addEventListener('click', () => {
            if (searchInput.value) {
                window.location.href = `{{route('shop.products.index')}}?search=${searchInput.value}`;
            }
        });

        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && searchInput.value) {
                window.location.href = `{{route('shop.products.index')}}?search=${searchInput.value}`;
            }
        });
    </script>
</body>
</html>
