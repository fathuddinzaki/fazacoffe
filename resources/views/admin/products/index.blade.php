@extends('layouts.admin')
@section('title', 'Products')
@section('page-label', 'Workspace / Products')
@section('content')
<section class="admin-page-heading">
    <div><p class="eyebrow">YOUR MENU, YOUR WAY</p><h1>Products</h1><p>Keep the Faza menu fresh and up to date.</p></div>
    <a class="button" href="{{ route('admin.products.create') }}">Add a product <span aria-hidden="true">+</span></a>
</section>
<section class="admin-content-card">
    <div class="admin-section-heading">
        <div><p class="eyebrow">MENU INVENTORY</p><h2>{{ $products->total() }} products</h2></div>
        <form class="admin-search" method="GET" action="{{ route('admin.products.index') }}">
            <label class="sr-only" for="product-search">Search products</label>
            <input id="product-search" name="search" type="search" value="{{ request('search') }}" placeholder="Search products">
            <button type="submit" aria-label="Search">⌕</button>
        </form>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Product</th><th>Category</th><th>Price</th><th>Visibility</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td><div class="table-product">@if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">@else<span class="table-placeholder">FC</span>@endif<span>{{ $product->name }}</span></div></td>
                        <td><span class="table-tag">{{ $product->category->name }}</span></td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td><span class="status-tag {{ $product->is_featured ? 'status-featured' : '' }}">{{ $product->is_featured ? 'Featured' : 'On menu' }}</span></td>
                        <td><div class="table-actions"><a class="table-action" href="{{ route('admin.products.edit', $product) }}" aria-label="Edit {{ $product->name }}">Edit</a><form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">@csrf @method('DELETE')<button class="table-action table-action-danger" type="submit">Delete</button></form></div></td>
                    </tr>
                @empty
                    <tr><td class="table-empty" colspan="5"><span>☕</span><strong>No products found.</strong><p>Try a different search or add something to the menu.</p></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="admin-pagination">{{ $products->links() }}</div>
</section>
@endsection
