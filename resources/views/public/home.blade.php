@extends('layouts.public')
@section('title', 'Faza Coffee — A little coffee, a lot of stories')
@section('content')
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow"><span class="eyebrow-line"></span> A business by PT Fathuddin Zaki</p>
        <h1>A little coffee,<br><em>a lot of stories.</em></h1>
        <p class="hero-description">Discover the taste of carefully crafted coffee. From rich espresso to refreshing signature drinks, every cup at Faza Coffee is made to bring comfort and inspiration to your day.</p>
        <div class="hero-actions">
            <a class="button" href="{{ route('catalog') }}">Explore Our Menu <span aria-hidden="true">↗</span></a>
            <a class="text-link" href="{{ route('about') }}">Get to know us <span aria-hidden="true">→</span></a>
        </div>
        <div class="hero-caption"><span class="caption-dot"></span> Good coffee. Unhurried moments.</div>
    </div>
    <div class="hero-visual" aria-label="Featured Faza Coffee drink">
        <div class="hero-ring hero-ring-one"></div>
        <div class="hero-ring hero-ring-two"></div>
        <div class="hero-photo-wrap">
            @if($heroProduct?->image)
                <img class="hero-photo" src="{{ asset('storage/'.$heroProduct->image) }}" alt="{{ $heroProduct->name }}">
            @else
                <img class="hero-photo-fallback" src="{{ asset('images/faza_coffee.png') }}" alt="Faza Coffee logo">
            @endif
            <div class="hero-photo-caption">
                <span>FROM THE FAZA MENU</span>
                <strong>{{ $heroProduct?->name ?? 'Brewed with care' }}</strong>
                @if($heroProduct)<span>Rp {{ number_format($heroProduct->price, 0, ',', '.') }}</span>@endif
            </div>
        </div>
        <span class="hero-stamp">EST. WITH<br>GOOD TASTE</span>
    </div>
</section>

<section class="section section-featured">
    <div class="section-heading">
        <div><p class="eyebrow">From our bar</p><h2>Made for your moment.</h2></div>
        <a class="text-link" href="{{ route('catalog') }}">Explore the menu <span aria-hidden="true">→</span></a>
    </div>
    <div class="product-grid">
        @forelse($featured as $product)
            <article class="product-card">
                <a class="product-media" href="{{ route('product.show', $product->slug) }}" aria-label="View {{ $product->name }}">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" loading="lazy">
                    @else
                        <span class="product-placeholder" aria-hidden="true"><span>FC</span><b class="cup-illustration"><i></i></b></span>
                    @endif
                    <span class="media-index">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                </a>
                <div class="product-info">
                    <div class="product-meta"><span>{{ $product->category->name }}</span><span>Signature selection</span></div>
                    <h3>{{ $product->name }}</h3>
                    <p class="product-description">{{ \Illuminate\Support\Str::limit($product->description, 88) }}</p>
                    <div class="product-footer">
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a class="round-link" href="{{ route('product.show', $product->slug) }}" aria-label="Details for {{ $product->name }}">↗</a>
                    </div>
                </div>
            </article>
        @empty
            <p class="empty-state">Our menu is being prepared. Please check back soon.</p>
        @endforelse
    </div>
</section>

<section class="story-band">
    <div class="story-mark"><img src="{{ asset('images/faza_coffee.png') }}" alt=""></div>
    <div class="story-copy">
        <p class="eyebrow eyebrow-light">A little about us</p>
        <h2>More than a cup.<br><em>A reason to pause.</em></h2>
        <p>At Faza Coffee, we believe the best conversations start with a good cup. We bring together thoughtful ingredients, familiar flavors, and a warm welcome in every visit.</p>
        <a class="text-link text-link-light" href="{{ route('about') }}">Read our story <span aria-hidden="true">→</span></a>
    </div>
    <div class="story-note"><span>01</span><p>Quality<br>in every pour</p></div>
</section>

<section class="section category-section">
    <div class="section-heading">
        <div><p class="eyebrow">Find your favorite</p><h2>A menu for every mood.</h2></div>
        <a class="text-link" href="{{ route('catalog') }}">All products <span aria-hidden="true">→</span></a>
    </div>
    <div class="category-grid">
        @foreach($categories as $category)
            <a class="category-card" href="{{ route('catalog', ['category' => $category->slug]) }}">
                <span class="category-count">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ $category->products_count }} items</span>
                <h3>{{ $category->name }}</h3>
                <p>{{ $category->description }}</p>
                <span class="category-arrow" aria-hidden="true">↗</span>
            </a>
        @endforeach
    </div>
</section>

<section class="contact-strip">
    <div><p class="eyebrow">Come on in</p><h2>Your next favorite<br>cup is waiting.</h2></div>
    <p>Drop by, slow down, and let us make you something lovely.</p>
    <a class="button button-light" href="{{ route('contact') }}">Visit Faza Coffee <span aria-hidden="true">↗</span></a>
</section>
@endsection
