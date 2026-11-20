<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $featured = Product::with('category')->where('is_featured', true)->latest()->take(6)->get();
        $heroProduct = $featured->first();
        $categories = Category::withCount('products')->get();

        return view('public.home', compact('featured', 'heroProduct', 'categories'));
    }

    public function catalog(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $products = Product::with('category')
            ->when($request->category, function ($query, $slug) {
                $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', $slug));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('public.catalog', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->take(3)
            ->get();

        return view('public.detail', compact('product', 'related'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}
