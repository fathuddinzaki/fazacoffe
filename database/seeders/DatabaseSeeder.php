<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            'Coffee' => 'Classic espresso-based drinks and carefully brewed coffee.',
            'Non-Coffee' => 'Comforting chocolate, tea, and refreshing milk drinks.',
            'Pastry' => 'Freshly baked treats to enjoy with every cup.',
        ];

        foreach ($categories as $name => $description) {
            Category::create(['name' => $name, 'slug' => Str::slug($name), 'description' => $description]);
        }

        $coffee = Category::where('slug', 'coffee')->first();
        $nonCoffee = Category::where('slug', 'non-coffee')->first();
        $pastry = Category::where('slug', 'pastry')->first();

        $products = [
            ['category_id' => $coffee->id, 'name' => 'Faza Signature Latte', 'description' => 'Silky espresso, fresh milk, and Faza’s signature caramel finish.', 'price' => 28000, 'is_featured' => true],
            ['category_id' => $coffee->id, 'name' => 'Caramel Macchiato', 'description' => 'Espresso layered with vanilla milk and a rich caramel topping.', 'price' => 32000, 'is_featured' => true],
            ['category_id' => $coffee->id, 'name' => 'Kopi Susu Aren', 'description' => 'Bold local coffee balanced with creamy milk and palm sugar.', 'price' => 25000, 'is_featured' => true],
            ['category_id' => $coffee->id, 'name' => 'Americano', 'description' => 'A clean, aromatic espresso softened with hot water.', 'price' => 22000, 'is_featured' => false],
            ['category_id' => $nonCoffee->id, 'name' => 'Matcha Latte', 'description' => 'Earthy premium matcha whisked together with fresh milk.', 'price' => 30000, 'is_featured' => true],
            ['category_id' => $nonCoffee->id, 'name' => 'Chocolate Haze', 'description' => 'Dark chocolate and milk with a deep, comforting cocoa flavor.', 'price' => 30000, 'is_featured' => false],
            ['category_id' => $pastry->id, 'name' => 'Butter Croissant', 'description' => 'Flaky, golden pastry baked fresh for a light buttery bite.', 'price' => 18000, 'is_featured' => true],
            ['category_id' => $pastry->id, 'name' => 'Tiramisu Slice', 'description' => 'Coffee-soaked sponge, mascarpone cream, and cocoa dust.', 'price' => 35000, 'is_featured' => false],
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);
            Product::create($product);
        }
    }
}
