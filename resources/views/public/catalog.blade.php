@extends('layouts.public')
@section('title', 'Our menu — Faza Coffee')
@section('content')
<section class="page-intro">
    <p class="eyebrow"><span class="eyebrow-line"></span> Carefully made, always welcoming</p>
    <h1>Find your<br><em>kind of coffee.</em></h1>
    <p>From a familiar favorite to something new, there is a little goodness for every kind of day.</p>
    <span class="page-intro-count">{{ $products->total() }} MENU FAVORITES</span>
</section>

<section class="section catalog-section">
    <form class="catalog-toolbar" method="GET" action="{{ route('catalog') }}">
        <label class="search-field">
            <span class="sr-only">Search products</span>
            <span aria-hidden="true">⌕</span>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search the menu">
        </label>
        <label class="filter-field">
            <span class="sr-only">Filter by category</span>
            <select name="category" onchange="this.form.submit()">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
        </label>
        <button class="button" type="submit">Find a drink <span aria-hidden="true">→</span></button>
    </form>

    <div class="product-grid">
        @forelse($products as $product)
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
                    <div class="product-meta"><span>{{ $product->category->name }}</span></div>
                    <h2><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h2>
                    <p class="product-description">{{ \Illuminate\Support\Str::limit($product->description, 96) }}</p>
                    <div class="product-footer">
                        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <a class="round-link" href="{{ route('product.show', $product->slug) }}" aria-label="Details for {{ $product->name }}">↗</a>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state"><span aria-hidden="true">☕</span><h2>No matches just yet.</h2><p>Try another search or choose a different category.</p><a class="text-link" href="{{ route('catalog') }}">Clear filters <span aria-hidden="true">→</span></a></div>
        @endforelse
    </div>
    <div class="pagination">{{ $products->links() }}</div>
</section>
@endsection
