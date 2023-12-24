<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_create_category(): void
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('categories.create'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertViewIs('categories.create');
    }

    public function test_can_store_category(): void
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);
        $data = [
            'name' => $this->faker->unique()->word,
        ];

        $response = $this->post(route('categories.store'), $data);

        $response->assertRedirect(route('todos.index'));

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_can_delete_category(): void
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);
        
        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', ['category' => $category->id]));

        $response->assertRedirect(route('todos.index'));

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
