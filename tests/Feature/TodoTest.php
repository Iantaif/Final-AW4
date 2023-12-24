<?php

namespace Tests\Feature;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    public function test_can_create_todo(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
        $response = $this->post(route('todos.store'), $data);

        $response->assertRedirect(route('todos.index'));

        $this->assertDatabaseHas('todos', $data);
    }


    public function test_can_delete_a_todo()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $todo = Todo::factory()->create();

        $response = $this->delete(route('todos.destroy', ['todo' => $todo->id]));

        $response->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }



    public function test_can_update_a_todo()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $todo = Todo::factory()->create();

        $response = $this->put("/todos/{$todo->id}", [
            'user_id' => $user->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('todos', ['id' => $todo->id]);
    }


    public function it_can_show_the_create_form()
    {
        $response = $this->get(route('todos.create'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertViewIs('todos.create');
    }

    public function it_can_show_a_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->get(route('todos.show', ['todo' => $todo->id]));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertViewIs('todos.show');
    }
}
