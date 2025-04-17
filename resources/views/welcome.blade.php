<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ZiyadBooks | Landing Page</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        /* Base styles */
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            color: #1a202c;
            background-color: #f0f4f8;
            transition: background-color 0.3s, color 0.3s;
        }

        body.dark {
            background-color: #0f172a;
            color: #f3f4f6;
        }

        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Hero section */
        .hero {
            max-width: 48rem;
            text-align: center;
            z-index: 1;
        }

        .gradient-text {
            background: linear-gradient(to right, #3b82f6, #2dd4bf);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .subtitle {
            font-size: 1.25rem;
            color: #4b5563;
            margin-bottom: 2rem;
        }

        body.dark .subtitle {
            color: #d1d5db;
        }

        /* Buttons */
        .btn-container {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(to right, #3b82f6, #2dd4bf);
            color: white;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.35);
        }

        .btn-secondary {
            border: 1px solid #d1d5db;
            color: #4b5563;
            background-color: transparent;
        }

        body.dark .btn-secondary {
            border-color: #4b5563;
            color: #e5e7eb;
        }

        .btn-secondary:hover {
            background-color: rgba(0, 0, 0, 0.05);
            transform: translateY(-3px);
        }

        body.dark .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Features section */
        .features {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 2rem;
            width: 100%;
            max-width: 72rem;
            margin-top: 4rem;
        }

        @media (min-width: 768px) {
            .features {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .feature-card {
            padding: 1.5rem;
            border-radius: 1rem;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        body.dark .feature-card {
            background-color: #1e293b;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px) rotate(1deg);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }

        body.dark .feature-card:hover {
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.25);
        }

        .feature-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .feature-card p {
            color: #6b7280;
            font-size: 1rem;
            line-height: 1.5;
        }

        body.dark .feature-card p {
            color: #9ca3af;
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #3b82f6;
            transition: transform 0.5s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.2) rotate(-5deg);
        }

        /* Footer */
        footer {
            margin-top: 4rem;
            color: #6b7280;
            font-size: 0.875rem;
            text-align: center;
        }

        body.dark footer {
            color: #9ca3af;
        }

        /* Background effects */
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            z-index: 0;
            pointer-events: none;
        }

        /* Animated elements */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* Theme toggle */
        .theme-toggle {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            color: #4b5563;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 10;
        }

        body.dark .theme-toggle {
            color: #e5e7eb;
        }

        /* Additional decorative elements */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(to right, #3b82f6, #2dd4bf);
            opacity: 0.08;
            z-index: -1;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            bottom: -200px;
            right: -200px;
        }

        /* Book animations */
        .book-animation {
            position: absolute;
            opacity: 0.6;
            pointer-events: none;
        }

        .book-1 {
            top: 15%;
            left: 10%;
            animation: float 5s ease-in-out infinite;
        }

        .book-2 {
            bottom: 20%;
            right: 10%;
            animation: float 7s ease-in-out infinite reverse;
        }

        /* Wave animation */
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%233b82f6' fill-opacity='0.1' d='M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,213.3C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: 1440px 100px;
            animation: wave 15s linear infinite;
        }

        .wave-2 {
            opacity: 0.3;
            height: 120px;
            animation-duration: 10s;
            animation-direction: reverse;
        }

        @keyframes wave {
            0% {
                background-position-x: 0;
            }
            100% {
                background-position-x: 1440px;
            }
        }

        /* Particle animation */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #3b82f6;
            border-radius: 50%;
            opacity: 0.3;
        }

        /* Book opening animation */
        .book-open {
            position: absolute;
            width: 60px;
            height: 40px;
            z-index: 1;
        }

        .book-open .cover {
            position: absolute;
            width: 30px;
            height: 40px;
            background-color: #3b82f6;
            border-radius: 2px;
            transition: transform 0.5s ease;
        }

        .book-open .cover-left {
            left: 0;
            transform-origin: left;
            transform: rotateY(0deg);
        }

        .book-open .cover-right {
            right: 0;
            transform-origin: right;
            transform: rotateY(0deg);
        }

        .book-open:hover .cover-left {
            transform: rotateY(-60deg);
        }

        .book-open:hover .cover-right {
            transform: rotateY(60deg);
        }

        .book-open .pages {
            position: absolute;
            left: 15px;
            width: 30px;
            height: 36px;
            background-color: white;
            border-radius: 1px;
            z-index: -1;
        }

        .book-open-1 {
            top: 30%;
            left: 20%;
            transform: rotate(-15deg);
        }

        .book-open-2 {
            top: 60%;
            right: 15%;
            transform: rotate(10deg);
            animation: float 9s ease-in-out infinite;
        }

        /* Spotlight effect */
        .spotlight {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 2;
            opacity: 0.05;
            background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), #3b82f6 0%, transparent 50%);
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Background elements -->
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>

        <!-- Wave animation -->
        <div class="wave"></div>
        <div class="wave wave-2"></div>

        <!-- Particles -->
        <div class="particles" id="particles"></div>

        <!-- Spotlight effect -->
        <div class="spotlight" id="spotlight"></div>

        <!-- Book animations -->
        <div class="book-animation book-1">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
        </div>

        <div class="book-animation book-2">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#2dd4bf" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
            </svg>
        </div>

        <!-- Interactive Book elements -->
        <div class="book-open book-open-1">
            <div class="cover cover-left"></div>
            <div class="pages"></div>
            <div class="cover cover-right"></div>
        </div>

        <div class="book-open book-open-2">
            <div class="cover cover-left"></div>
            <div class="pages"></div>
            <div class="cover cover-right"></div>
        </div>

        <!-- Theme toggle button -->
        <button class="theme-toggle" id="themeToggle">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="moon">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="sun" style="display: none;">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
        </button>

        <!-- Hero Section -->
        <div class="hero">
            <h1 class="title floating">Welcome to <span class="gradient-text">ZiyadBooks</span></h1>
            <p class="subtitle">Kelola stok, pemesanan, penjualan & analisis tren dengan mudah. Semua di satu tempat.</p>
            <div class="btn-container">
                <a href="{{route('shop.products.index')}}" class="btn btn-primary">Pesan Sekarang</a>
                <a href="login" class="btn btn-secondary">Login</a>
            </div>
        </div>

        <!-- Feature Cards -->
        <section class="features">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </div>
                <h3>Manajemen Produk</h3>
                <p>Tambah, edit, dan kelola stok buku dengan mudah. Pantau inventaris Anda secara real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                        <line x1="2" y1="20" x2="22" y2="20"></line>
                    </svg>
                </div>
                <h3>Analisis Penjualan</h3>
                <p>Dapatkan insight tren penjualan mingguan & bulanan. Visualisasi data yang mudah dipahami.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="10" r="3"></circle>
                        <path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 6.9 8 11.7z"></path>
                    </svg>
                </div>
                <h3>Tanpa Login</h3>
                <p>Pemesanan cepat langsung dari halaman landing. Pengalaman berbelanja yang lancar dan mudah.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            &copy; <span id="currentYear"></span> ZiyadBooks. All rights reserved.
        </footer>
    </div>

    <script>
        // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const moon = document.querySelector('.moon');
        const sun = document.querySelector('.sun');

        // Check for saved theme preference or use user's system preference
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && prefersDark)) {
            document.body.classList.add('dark');
            moon.style.display = 'none';
            sun.style.display = 'block';
        }

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');

            if (document.body.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                moon.style.display = 'none';
                sun.style.display = 'block';
            } else {
                localStorage.setItem('theme', 'light');
                moon.style.display = 'block';
                sun.style.display = 'none';
            }
        });

        // Add scroll animation to feature cards
        const featureCards = document.querySelectorAll('.feature-card');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        featureCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });

        // Create particles
        const particlesContainer = document.getElementById('particles');
        const particlesCount = 20;

        for (let i = 0; i < particlesCount; i++) {
            createParticle();
        }

        function createParticle() {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            // Random position
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;

            // Random size
            const size = Math.random() * 8 + 2;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;

            // Random opacity
            particle.style.opacity = Math.random() * 0.2 + 0.1;

            // Animation
            const duration = Math.random() * 20 + 10;
            particle.style.animation = `float ${duration}s ease-in-out infinite`;
            particle.style.animationDelay = `${Math.random() * 5}s`;

            particlesContainer.appendChild(particle);
        }

        // Spotlight effect
        const spotlight = document.getElementById('spotlight');

        document.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth * 100;
            const y = e.clientY / window.innerHeight * 100;

            spotlight.style.setProperty('--x', `${x}%`);
            spotlight.style.setProperty('--y', `${y}%`);
        });
    </script>
</body>
</html>
