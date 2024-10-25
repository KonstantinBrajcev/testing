<?php
    namespace Tests\Feature;

    use App\Models\Product;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_products_can_be_indexed()
    {
        $response = $this->get('products');
        $response->assertStatus(200);
    }
    public function test_product_can_be_shown()
    {
        $product = Product::factory()->create();
        $response = $this->get('products/' . $product->id);
        $response->assertStatus(200)
                 ->assertJsonFragment([
                    'id' => $product->id,
                 'sku' => $product->sku,
                 'name' => $product->name,
                 'price' => (string) $product->price,
                ]);
    }

    public function test_product_can_be_stored()
    {
        $data = [
            'sku' => 'test-sku',
            'name' => 'Test Product',
            'price' => 10.99,
        ];
        $response = $this->post('products', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment($data);
    }

    public function test_product_can_be_updated()
    {
        $product = Product::factory()->create();
        $data = [
            'sku' => 'upd-sku',
            'name' => 'Updated Product',
            'price' => 88.88,
        ];
        $response = $this->put('products/' . $product->id, $data);
        $response->assertStatus(200)
                 ->assertJsonFragment(array_merge(['id' => $product->id], $data));
    }

    public function test_product_can_be_destroyed()
    {
        $product = Product::factory()->create();
        $this->delete('products/'.$product->id)->assertStatus(204);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
