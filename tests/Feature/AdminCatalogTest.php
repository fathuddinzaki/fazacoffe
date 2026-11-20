<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['is_admin' => true]));
    }

    public function test_product_crud_uploads_replaces_and_removes_images(): void
    {
        Storage::fake('public');
        $category = Category::create([
            'name' => 'Coffee',
            'slug' => 'coffee',
            'description' => 'Coffee drinks',
        ]);

        $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name' => 'Latte',
            'description' => 'A smooth coffee drink.',
            'price' => 28000,
            'image' => UploadedFile::fake()->image('latte.png'),
        ])->assertRedirect(route('admin.products.index'));

        $product = Product::firstOrFail();
        $firstImage = $product->image;
        Storage::disk('public')->assertExists($firstImage);

        $this->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Latte',
            'description' => 'An updated smooth coffee drink.',
            'price' => 30000,
            'image' => UploadedFile::fake()->image('latte-new.png'),
        ])->assertRedirect(route('admin.products.index'));

        $product->refresh();
        $this->assertSame('30000.00', $product->price);
        $this->assertNotSame($firstImage, $product->image);
        Storage::disk('public')->assertMissing($firstImage);
        Storage::disk('public')->assertExists($product->image);

        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($product->image);
    }

    public function test_product_validation_rejects_missing_required_fields(): void
    {
        $this->from(route('admin.products.create'))
            ->post(route('admin.products.store'), [])
            ->assertRedirect(route('admin.products.create'))
            ->assertSessionHasErrors(['category_id', 'name', 'description', 'price']);
    }

    public function test_product_validation_rejects_non_image_uploads(): void
    {
        $category = Category::create([
            'name' => 'Coffee',
            'slug' => 'coffee',
            'description' => 'Coffee drinks',
        ]);

        $this->from(route('admin.products.create'))
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => 'Latte',
                'description' => 'A smooth coffee drink.',
                'price' => 28000,
                'image' => UploadedFile::fake()->create('not-an-image.txt', 1, 'text/plain'),
            ])
            ->assertRedirect(route('admin.products.create'))
            ->assertSessionHasErrors('image');
    }

    public function test_duplicate_names_receive_unique_slugs_for_products_and_categories(): void
    {
        $this->post(route('admin.categories.store'), ['name' => 'Coffee'])
            ->assertRedirect(route('admin.categories.index'));
        $this->post(route('admin.categories.store'), ['name' => 'Coffee'])
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseHas('categories', ['slug' => 'coffee-2']);

        $category = Category::firstOrFail();
        $this->get(route('admin.categories.edit', $category))->assertOk();
        $this->put(route('admin.categories.update', $category), [
            'name' => 'Tea',
            'description' => 'Tea drinks',
        ])->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'slug' => 'tea']);

        foreach (['Latte', 'Latte'] as $name) {
            $this->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => $name,
                'description' => 'A coffee drink.',
                'price' => 28000,
            ])->assertRedirect(route('admin.products.index'));
        }

        $this->assertDatabaseHas('products', ['slug' => 'latte-2']);
    }

    public function test_deleting_a_category_removes_its_products_and_uploaded_images(): void
    {
        Storage::fake('public');
        $category = Category::create([
            'name' => 'Coffee',
            'slug' => 'coffee',
            'description' => 'Coffee drinks',
        ]);
        Storage::disk('public')->put('products/coffee.png', 'image');
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Espresso',
            'slug' => 'espresso',
            'description' => 'A short coffee.',
            'price' => 20000,
            'image' => 'products/coffee.png',
        ]);

        $this->delete(route('admin.categories.destroy', $category))
            ->assertRedirect(route('admin.categories.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing('products/coffee.png');
    }

    public function test_database_seeder_creates_at_least_five_products(): void
    {
        $this->seed();

        $this->assertGreaterThanOrEqual(5, Product::count());
        $this->assertGreaterThanOrEqual(3, Category::count());
        $this->assertSame(0, Product::whereDoesntHave('category')->count());
    }
}
