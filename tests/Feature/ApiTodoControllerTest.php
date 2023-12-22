<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiTodoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_get_list_of_todos()
    {
        Todo::factory(5)->create();

        $response = $this->getJson('/api/v1/todos');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'description',
                        'is_completed',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    public function test_can_create_todo()
    {
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $response = $this->postJson('/api/v1/todos', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'id',
                'title',
                'description',
                'is_completed',
                'created_at',
                'updated_at',
            ]);
    }

    public function test_can_get_todo_by_id()
    {
        $todo = Todo::factory()->create();

        $response = $this->getJson("/api/v1/todos/{$todo->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id' => $todo->id,
                'title' => $todo->title,
                'description' => $todo->description,
                'is_completed' => $todo->is_completed,
            ]);
    }

    public function test_can_update_todo()
    {
        $todo = Todo::factory()->create();
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_completed' => $this->faker->boolean,
        ];

        $response = $this->putJson("/api/v1/todos/{$todo->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id' => $todo->id,
                'title' => $data['title'],
                'description' => $data['description'],
                'is_completed' => $data['is_completed'],
            ]);
    }

    public function test_can_delete_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->deleteJson("/api/v1/todos/{$todo->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Todo deleted successfully']);

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
