<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ZiyadBooks | Toko Buku Premium</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #3547e9;
            --primary-dark: #246aed;
            --primary-light: #c4b5fd;
            --secondary: #f5f3ff;
            --accent: #386fd6;
            --accent-light: #ddd6fe;
            --gold: #d4af37;
            --gold-light: #f7f0d7;
            --text: #1e293b;
            --text-light: #64748b;
            --background: #ffffff;
            --card: #ffffff;
            --border: #e2e8f0;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .dark {
            --primary: #8b5cf6;
            --primary-dark: #7c3aed;
            --primary-light: #a78bfa;
            --secondary: #2e1065;
            --accent: #c4b5fd;
            --accent-light: #4c1d95;
            --gold: #f7b94c;
            --gold-light: #4c3a1e;
            --text: #f8fafc;
            --text-light: #cbd5e1;
            --background: #0f172a;
            --card: #1e293b;
            --border: #334155;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -4px rgba(0, 0, 0, 0.2);
            --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -2px rgba(0, 0, 0, 0.2);
            --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.2);
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
            transition: background-color 0.3s, color 0.3s;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
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
            box-shadow: var(--shadow-soft);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo svg {
            width: 28px;
            height: 28px;
            stroke: var(--gold);
            fill: none;
        }

        .logo span {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            padding: 0.5rem 0;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link.btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 6px rgba(139, 92, 246, 0.25);
        }

        .nav-link.btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(139, 92, 246, 0.35);
        }

        /* Hero Section */
        .hero {
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .hero-container {
            padding: 6rem 0;
            display: flex;
            align-items: center;
            gap: 3rem;
            position: relative;
            z-index: 1;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -10vw; /* tadinya -100px */
            right: -10vw;
            width: clamp(150px, 25vw, 400px); /* minimal 200px, maksimal 400px, fleksibel */
            height: clamp(200px, 30vw, 400px);
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary-light) 0%, rgba(139, 92, 246, 0) 70%);
            opacity: 0.4;
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--gold-light) 0%, rgba(212, 175, 55, 0) 70%);
            opacity: 0.4;
            z-index: 0;
        }

        .hero-content {
            flex: 1;
            position: relative;
            z-index: 2;
        }

        .hero-subtitle-tag {
            display: inline-block;
            background-color: var(--accent-light);
            color: var(--primary);
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.25rem 1rem;
            border-radius: 2rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--text);
            letter-spacing: -0.5px;
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            display: inline-block;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 6px;
            bottom: 8px;
            left: 0;
            background-color: var(--gold-light);
            z-index: -1;
            opacity: 0.6;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 36rem;
            font-weight: 300;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            gap: 1.25rem;
        }

        .btn {
            display: inline-block;
            padding: 0.875rem 1.75rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 2rem;
            transition: all 0.3s;
            cursor: pointer;
            letter-spacing: 0.5px;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 10px rgba(139, 92, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(139, 92, 246, 0.4);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text);
            border: 1px solid var(--primary-light);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent-light) 100%);
            transition: width 0.3s ease;
            z-index: -1;
            opacity: 0.2;
        }

        .btn-secondary:hover::before {
            width: 100%;
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary-dark);
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .hero-image img {
            max-width: 60%; /* dari parent container */
            height: auto;
            border-radius: 1rem;
            box-shadow: var(--shadow);
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.5s, box-shadow 0.5s;
            border: 5px solid white;
        }

        .hero-image img:hover {
            transform: perspective(1000px) rotateY(0deg);
            box-shadow: var(--shadow-hover);
        }

        .hero-image::before {
            content: '';
            position: absolute;
            width: 80%;
            height: 100%;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--accent-light) 100%);
            z-index: -1;
            border-radius: 1rem;
            opacity: 0.2;
        }

        /* Theme Toggle */
        .theme-toggle {
            background: none;
            border: none;
            color: var(--text);
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .theme-toggle:hover {
            background-color: var(--secondary);
            transform: rotate(15deg);
        }

        .theme-toggle svg {
            width: 20px;
            height: 20px;
            transition: transform 0.3s;
        }

        .theme-toggle:hover svg {
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
                padding: 3rem 0;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-image {
                order: -1;
                margin-bottom: 2rem;
            }

            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero::before, .hero::after {
                opacity: 0.2;
            }
        }

        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }

        /* Animation elements */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        /* Mobile menu button */
        .mobile-menu-btn {
            background: none;
            border: none;
            color: var(--text);
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s;
            border: 1px solid var(--border);
        }

        .mobile-menu-btn:hover {
            background-color: var(--secondary);
        }

        /* Decorative elements */
        .decorative-border {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, var(--gold) 0%, rgba(212, 175, 55, 0) 100%);
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container container">
            <a href="/" class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span>ZiyadBooks</span>
            </a>
            <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                <svg class="moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
                <svg class="sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
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
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-container">
                <div class="hero-content">
                    <div class="hero-subtitle-tag">Premium Collection</div>
                    <h1 class="hero-title">Discover Literary Elegance at <span>ZiyadBooks</span></h1>
                    <p class="hero-subtitle">Immerse yourself in our curated collection of premium books across diverse genres. Each title selected for quality, significance, and the joy of reading.</p>
                    <div class="hero-buttons">
                        <a href="{{route('shop.products.index')}}" class="btn btn-primary">Explore Collection</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Member Login</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2730&q=80" alt="Elegant book collection with gold decorative elements">
                </div>
            </div>
        </div>
        <span id="currentYear" style="display: none;"></span>
    </section>
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

        // Mobile menu functionality
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');

        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Add subtle animation to hero image on page load
        window.addEventListener('load', () => {
            const heroImage = document.querySelector('.hero-image img');
            setTimeout(() => {
                heroImage.style.transform = 'perspective(1000px) rotateY(-5deg)';
            }, 300);
        });
    </script>
</body>
</html>
