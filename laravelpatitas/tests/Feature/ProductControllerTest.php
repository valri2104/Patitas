<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_displays_products_view_with_correct_data(): void
    {
        Product::factory()->count(5)->create();

        $response = $this->get(route('product.index'));

        $response->assertStatus(200)
                 ->assertViewIs('product.index')
                 ->assertViewHas('viewData');

        $viewData = $response->viewData('viewData');

        $this->assertArrayHasKey('products', $viewData);
        $this->assertArrayHasKey('topProducts', $viewData);
        $this->assertArrayHasKey('cheapProducts', $viewData);
    }

    /** @test */
    public function show_displays_product_with_reviews_and_user_flags(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('product.show', ['id' => $product->getId()]));

        $response->assertStatus(200)
                 ->assertViewIs('product.show')
                 ->assertViewHas('viewData');

        $viewData = $response->viewData('viewData');

        $this->assertEquals($product->getName(), $viewData['title']);
        $this->assertEquals($product->getId(), $viewData['product']->getId());
        $this->assertArrayHasKey('reviews', $viewData);
        $this->assertArrayHasKey('averageRating', $viewData);
        $this->assertArrayHasKey('canReview', $viewData);
        $this->assertArrayHasKey('hasPurchased', $viewData);
    }
}
