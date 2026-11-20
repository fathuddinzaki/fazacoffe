<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#24160f">
    <title>Admin sign in — Faza Coffee</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="login-page">
    <main class="login-shell">
        <aside class="login-story">
            <a class="login-back" href="{{ route('home') }}">← Back to Faza Coffee</a>
            <div class="login-story-content">
                <span class="login-kicker"><span class="caption-dot"></span> FAZA COFFEE / ADMIN</span>
                <img src="{{ asset('images/faza_coffee.png') }}" alt="Faza Coffee">
                <h1>A little care<br>goes a long way.</h1>
                <p>Good to have you back. Keep the little details that make Faza feel like Faza.</p>
            </div>
            <span class="login-story-foot">PT FATHUDDIN ZAKI · EST. WITH GOOD TASTE</span>
        </aside>
        <section class="login-panel">
            <div class="login-form-wrap">
                <p class="eyebrow"><span class="eyebrow-line"></span> ADMIN ACCESS</p>
                <h2>Welcome back.</h2>
                <p class="login-intro">Sign in to manage your menu and keep things brewing.</p>
                @if(session('status'))
                    <div class="alert" role="status">{{ session('status') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert error" role="alert">
                        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.login.store') }}" class="login-form">
                    @csrf
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="you@fazacoffee.com" autocomplete="username" required autofocus>
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input id="password" name="password" type="password" placeholder="Enter your password" autocomplete="current-password" required>
                        <button class="password-toggle" type="button" aria-label="Show password" aria-pressed="false">Show</button>
                    </div>
                    @error('password')<span class="field-error">{{ $message }}</span>@enderror
                    <button class="button login-submit" type="submit">Sign in to workspace <span aria-hidden="true">↗</span></button>
                </form>
                <p class="login-security"><span aria-hidden="true">●</span> Secure sign in for authorized administrators.</p>
            </div>
            <footer class="login-footer">&copy; 2026 Faza Coffee — PT Fathuddin Zaki</footer>
        </section>
    </main>
    <script>
        const passwordInput = document.querySelector('#password');
        const passwordToggle = document.querySelector('.password-toggle');
        passwordToggle.addEventListener('click', () => {
            const showPassword = passwordInput.type === 'password';
            passwordInput.type = showPassword ? 'text' : 'password';
            passwordToggle.textContent = showPassword ? 'Hide' : 'Show';
            passwordToggle.setAttribute('aria-label', showPassword ? 'Hide password' : 'Show password');
            passwordToggle.setAttribute('aria-pressed', String(showPassword));
        });
    </script>
</body>
</html>
