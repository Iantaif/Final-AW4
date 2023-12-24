<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Category;

class APICategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_list_categories()
    {
        $categories = Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'categories' => [
                    '*' => ['id', 'name', 'created_at', 'updated_at'],
                ],
            ]);
    }

    public function test_can_create_category()
    {
        $data = [
            'name' => $this->faker->word,
        ];

        $response = $this->postJson('/api/categories', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson(['category' => $data]);
    }

    public function test_can_show_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/categories/{$category->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['category' => $category->toArray()]);
    }

    public function test_can_update_category()
    {
        $category = Category::factory()->create();

        $data = [
            'name' => $this->faker->word,
        ];

        $response = $this->putJson("/api/categories/{$category->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['category' => $data]);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_can_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
