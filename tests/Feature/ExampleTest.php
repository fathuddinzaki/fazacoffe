<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_catalog_and_admin_dashboard_are_accessible(): void
    {
        $this->get('/products')->assertStatus(200);
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_product_detail_page_uses_slug(): void
    {
        $category = Category::create([
            'name' => 'Coffee',
            'slug' => 'coffee',
            'description' => 'Coffee drinks',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Faza Latte',
            'slug' => 'faza-latte',
            'description' => 'Smooth latte',
            'price' => 28000,
            'is_featured' => true,
        ]);

        $this->get('/products/'.$product->slug)->assertStatus(200);
    }
}
