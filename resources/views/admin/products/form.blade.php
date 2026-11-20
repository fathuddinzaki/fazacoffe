@extends('layouts.admin')
@section('title', $product ? 'Edit product' : 'Add product')
@section('page-label', 'Workspace / Products / '.($product ? 'Edit' : 'New'))
@section('content')
<section class="admin-page-heading">
    <div><p class="eyebrow">MENU EDITOR</p><h1>{{ $product ? 'A little update.' : 'Add something lovely.' }}</h1><p>{{ $product ? 'Make changes to this menu favorite.' : 'Add a new favorite to the Faza Coffee menu.' }}</p></div>
    <a class="text-link" href="{{ route('admin.products.index') }}">← Back to products</a>
</section>
<form class="admin-form-card" method="POST" action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    @if($product) @method('PUT') @endif
    <div class="form-section-heading"><span>01</span><div><h2>Product details</h2><p>Tell guests what makes this one special.</p></div></div>
    <div class="form-grid">
        <div class="form-field">
            <label for="name">Product name</label>
            <input id="name" name="name" value="{{ old('name', $product->name ?? '') }}" maxlength="150" placeholder="e.g. Faza Signature Latte" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-field">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                <option value="">Choose a category</option>
                @foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>{{ $category->name }}</option>@endforeach
            </select>
            @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-field form-field-wide">
            <label for="description">Description</label>
            <textarea id="description" name="description" maxlength="3000" rows="5" placeholder="A short, tempting description..." required>{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-field">
            <label for="price">Price <span>in rupiah</span></label>
            <div class="price-input"><span>Rp</span><input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product->price ?? '') }}" placeholder="28000" required></div>
            @error('price')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-field">
            <label for="image">Product photo <span>optional, max 2 MB</span></label>
            <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp">
            @error('image')<span class="field-error">{{ $message }}</span>@enderror
            @if($product?->image)
                <div class="current-image"><img src="{{ asset('storage/'.$product->image) }}" alt="Current photo of {{ $product->name }}"><span>Current product photo</span></div>
            @else
                <span class="field-hint">JPG, PNG, or WEBP. A coffee-toned placeholder appears when no photo is added.</span>
            @endif
        </div>
        <label class="featured-option">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false))>
            <span><strong>Feature this product</strong><small>Show it among the favorites on the homepage.</small></span>
        </label>
    </div>
    <div class="form-actions"><button class="button" type="submit">{{ $product ? 'Save changes' : 'Add to the menu' }} <span aria-hidden="true">→</span></button><a class="text-link" href="{{ route('admin.products.index') }}">Cancel</a></div>
</form>
@endsection
