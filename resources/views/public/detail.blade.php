@extends('layouts.public')
@section('title', $product->name.' — Faza Coffee')
@section('content')
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <a href="{{ route('home') }}">Home</a><span aria-hidden="true">/</span>
    <a href="{{ route('catalog') }}">Menu</a><span aria-hidden="true">/</span>
    <span>{{ $product->name }}</span>
</nav>
<section class="detail">
    <div class="detail-image">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
        @else
            <span class="product-placeholder product-placeholder-large" aria-hidden="true"><span>FC</span><b class="cup-illustration"><i></i></b></span>
        @endif
        <span class="detail-image-note">A Faza Coffee favorite</span>
    </div>
    <div class="detail-copy">
        <p class="eyebrow"><span class="eyebrow-line"></span>{{ $product->category->name }}</p>
        <h1>{{ $product->name }}</h1>
        <p class="detail-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <div class="detail-rule"></div>
        <p class="detail-description">{{ $product->description }}</p>
        <p class="detail-promise">Prepared fresh with care, just for you.</p>
        <div class="detail-actions">
            <a class="button" href="{{ route('contact') }}">Ask us about this <span aria-hidden="true">↗</span></a>
            <a class="text-link" href="{{ route('catalog') }}">← Back to the menu</a>
        </div>
    </div>
</section>
@if($related->count())
    <section class="section related-section">
        <div class="section-heading"><div><p class="eyebrow">Keep exploring</p><h2>You may also enjoy.</h2></div></div>
        <div class="product-grid">
            @foreach($related as $item)
                <article class="product-card">
                    <a class="product-media" href="{{ route('product.show', $item->slug) }}" aria-label="View {{ $item->name }}">
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->name }}" loading="lazy">
                        @else
                            <span class="product-placeholder" aria-hidden="true"><span>FC</span><b class="cup-illustration"><i></i></b></span>
                        @endif
                        <span class="media-index">↗</span>
                    </a>
                    <div class="product-info"><div class="product-meta"><span>{{ $item->category->name }}</span></div><h2>{{ $item->name }}</h2><div class="product-footer"><span class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</span><a class="round-link" href="{{ route('product.show', $item->slug) }}" aria-label="Details for {{ $item->name }}">↗</a></div></div>
                </article>
            @endforeach
        </div>
    </section>
@endif
@endsection
