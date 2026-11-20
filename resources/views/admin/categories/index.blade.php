@extends('layouts.admin')
@section('title', 'Categories')
@section('page-label', 'Workspace / Categories')
@section('content')
<section class="admin-page-heading">
    <div><p class="eyebrow">A PLACE FOR EVERY FAVORITE</p><h1>Categories</h1><p>Organize the menu into simple, easy-to-browse groups.</p></div>
    <a class="button" href="{{ route('admin.categories.create') }}">Add a category <span aria-hidden="true">+</span></a>
</section>
<section class="admin-content-card">
    <div class="admin-section-heading"><div><p class="eyebrow">MENU ORGANIZATION</p><h2>{{ $categories->total() }} categories</h2></div></div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Category</th><th>Description</th><th>Products</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td><div class="category-name"><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><strong>{{ $category->name }}</strong></div></td>
                        <td>{{ $category->description ?: 'No description' }}</td>
                        <td><span class="table-tag">{{ $category->products_count }} items</span></td>
                        <td><div class="table-actions"><a class="table-action" href="{{ route('admin.categories.edit', $category) }}">Edit</a><form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category and all of its products?')">@csrf @method('DELETE')<button class="table-action table-action-danger" type="submit">Delete</button></form></div></td>
                    </tr>
                @empty
                    <tr><td class="table-empty" colspan="4"><span>✳</span><strong>No categories yet.</strong><p>Create a category to start organizing your menu.</p></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="admin-pagination">{{ $categories->links() }}</div>
</section>
@endsection
