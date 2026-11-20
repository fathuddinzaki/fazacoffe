@extends('layouts.admin')
@section('title', $category ? 'Edit category' : 'Add category')
@section('page-label', 'Workspace / Categories / '.($category ? 'Edit' : 'New'))
@section('content')
<section class="admin-page-heading">
    <div><p class="eyebrow">MENU ORGANIZATION</p><h1>{{ $category ? 'Refine a category.' : 'Create a category.' }}</h1><p>Give guests a clear way to find their next favorite.</p></div>
    <a class="text-link" href="{{ route('admin.categories.index') }}">← Back to categories</a>
</section>
<form class="admin-form-card admin-form-narrow" method="POST" action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
    @csrf
    @if($category) @method('PUT') @endif
    <div class="form-section-heading"><span>01</span><div><h2>Category details</h2><p>A name and a little context go a long way.</p></div></div>
    <div class="form-field">
        <label for="name">Category name</label>
        <input id="name" name="name" value="{{ old('name', $category->name ?? '') }}" maxlength="100" placeholder="e.g. Coffee" required>
        @error('name')<span class="field-error">{{ $message }}</span>@enderror
    </div>
    <div class="form-field">
        <label for="description">Description <span>optional</span></label>
        <textarea id="description" name="description" maxlength="1000" rows="5" placeholder="What belongs in this part of the menu?">{{ old('description', $category->description ?? '') }}</textarea>
        @error('description')<span class="field-error">{{ $message }}</span>@enderror
    </div>
    <div class="form-actions"><button class="button" type="submit">{{ $category ? 'Save changes' : 'Create category' }} <span aria-hidden="true">→</span></button><a class="text-link" href="{{ route('admin.categories.index') }}">Cancel</a></div>
</form>
@endsection
