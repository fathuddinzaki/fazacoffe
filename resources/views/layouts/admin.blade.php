<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#24160f">
    <title>@yield('title', 'Admin') — Faza Coffee</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="admin-body">
    <aside class="admin-sidebar">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/faza_coffee.png') }}" alt="">
            <span>FAZA COFFEE<small>STUDIO / ADMIN</small></span>
        </a>
        <p class="sidebar-label">WORKSPACE</p>
        <nav class="admin-nav" aria-label="Admin navigation">
            <a class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}" href="{{ route('admin.dashboard') }}"><span>01</span>Overview</a>
            <a class="{{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}" href="{{ route('admin.products.index') }}"><span>02</span>Products</a>
            <a class="{{ request()->routeIs('admin.categories.*') ? 'is-active' : '' }}" href="{{ route('admin.categories.index') }}"><span>03</span>Categories</a>
        </nav>
        <div class="sidebar-bottom">
            <a class="back-to-site" href="{{ route('home') }}">← View website</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="logout-button" type="submit"><span aria-hidden="true">↗</span> Sign out</button>
            </form>
            <div class="admin-user"><span class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span><span>{{ auth()->user()->name }}<small>Administrator</small></span></div>
        </div>
    </aside>
    <main class="admin-main">
        <header class="admin-topbar">
            <div><span class="admin-overline">FAZA COFFEE / MANAGEMENT</span><p>@yield('page-label', 'Workspace')</p></div>
            <a class="admin-view-site" href="{{ route('home') }}">View store <span aria-hidden="true">↗</span></a>
        </header>
        @if(session('success'))
            <div class="alert" role="status">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert error" role="alert">
                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
