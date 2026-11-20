@extends('layouts.admin')
@section('title', 'Overview')
@section('page-label', 'Overview / Dashboard')
@section('content')
<section class="admin-page-heading">
    <div><p class="eyebrow">YOUR COFFEE CORNER</p><h1>Good to see you, {{ auth()->user()->name }}.</h1><p>Here is what is happening at Faza Coffee today.</p></div>
    <a class="button" href="{{ route('admin.products.create') }}">Add a product <span aria-hidden="true">+</span></a>
</section>
<section class="admin-stats">
    <article class="admin-stat"><span class="stat-label">ON THE MENU</span><strong>{{ $productCount }}</strong><span>Products available</span><span class="stat-mark">01</span></article>
    <article class="admin-stat"><span class="stat-label">MENU GROUPS</span><strong>{{ $categoryCount }}</strong><span>Product categories</span><span class="stat-mark">02</span></article>
    <article class="admin-stat admin-stat-dark"><span class="stat-label">FAZA FAVORITES</span><strong>{{ $featuredCount }}</strong><span>Featured selections</span><span class="stat-mark">03</span></article>
</section>
<section class="admin-content-card">
    <div class="admin-section-heading"><div><p class="eyebrow">RECENTLY UPDATED</p><h2>Latest products</h2></div><a class="text-link" href="{{ route('admin.products.index') }}">Manage products <span aria-hidden="true">→</span></a></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Product</th><th>Category</th><th>Price</th><th></th></tr></thead>
            <tbody>
                @forelse($latestProducts as $product)
                    <tr>
                        <td><div class="table-product">@if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="">@else<span class="table-placeholder">FC</span>@endif<span>{{ $product->name }}</span></div></td>
                        <td><span class="table-tag">{{ $product->category->name }}</span></td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td><a class="table-action" href="{{ route('admin.products.edit', $product) }}" aria-label="Edit {{ $product->name }}">↗</a></td>
                    </tr>
                @empty
                    <tr><td class="table-empty" colspan="4">No products yet. Add the first item to your menu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
