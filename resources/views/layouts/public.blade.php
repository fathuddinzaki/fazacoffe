<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#24160f">
    <title>@yield('title', 'Faza Coffee')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="brand-lockup" href="{{ route('home') }}" aria-label="Faza Coffee home">
                <img src="{{ asset('images/faza_coffee.png') }}" alt="">
                <span>Faza Coffee<small>A little coffee, a lot of stories.</small></span>
            </a>
            <button class="menu-toggle" type="button" aria-controls="primary-nav" aria-expanded="false" aria-label="Open navigation">
                <span></span><span></span>
            </button>
            <nav class="site-nav" id="primary-nav">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('catalog') }}">Products</a>
                <a href="{{ route('about') }}">Our story</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a class="nav-admin" href="{{ route('admin.dashboard') }}">Admin <span aria-hidden="true">↗</span></a>
            </nav>
        </div>
    </header>

    <main>@yield('content')</main>

    <footer class="site-footer">
        <div class="footer-main">
            <div class="footer-brand">
                <img src="{{ asset('images/faza_coffee.png') }}" alt="">
                <div><strong>Faza Coffee</strong><span>A little coffee, a lot of stories.</span></div>
            </div>
            <p class="footer-note">Thoughtfully brewed for the moments worth remembering.</p>
            <nav class="footer-nav" aria-label="Footer navigation">
                <a href="{{ route('catalog') }}">Menu</a>
                <a href="{{ route('about') }}">Our story</a>
                <a href="{{ route('contact') }}">Contact</a>
            </nav>
        </div>
        <div class="footer-bottom">
            <span>&copy; 2026 Faza Coffee — A Business by PT Fathuddin Zaki.</span>
            <span>Made for good coffee and good company.</span>
        </div>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const siteNav = document.querySelector('#primary-nav');
        menuToggle?.addEventListener('click', () => {
            const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!isOpen));
            menuToggle.setAttribute('aria-label', isOpen ? 'Open navigation' : 'Close navigation');
            siteNav.classList.toggle('is-open', !isOpen);
        });
    </script>
</body>
</html>
