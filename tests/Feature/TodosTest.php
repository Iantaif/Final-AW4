<?php

namespace Tests\Feature;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class TodosTest extends TestCase
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

        // Additional assertions to check if data is stored in the database
        $this->assertDatabaseHas('todos', $data);
    }
    public function test_can_delete_a_todo()
    {
        $todo = Todo::create([
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_completed' => $this->faker->boolean,
        ]);

        $response = $this->delete(route('todos.destroy', ['id' => $todo->id]));

        $response->assertStatus(Response::HTTP_FOUND);

        // Additional assertions to check if data is deleted from the database
        $this->assertDatabaseHas('todos', ['id' => $todo->id]);

    }

    public function test_can_update_a_todo()
    {
        $todo = Todo::create([
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_completed' => $this->faker->boolean,
        ]);
    
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_completed' => $this->faker->boolean,
        ];
    
        $response = $this->put(route('todos.update', ['id' => $todo->id]), $data);
    
        $response->assertStatus(Response::HTTP_FOUND);
    
        // Additional assertions to check if data is updated in the database
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'is_completed' => $data['is_completed'],
        ]);
        dump('Actual Data:', Todo::find($todo->id)->toArray());
        dump('Expected Data:', $data);
    }
    public function it_can_show_the_create_form()
    {
        $response = $this->get(route('todos.create'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('todos.create');
    }
    public function it_can_show_a_todo()
    {
        $todo = Todo::create([
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_completed' => $this->faker->boolean,
        ]);

        $response = $this->get(route('todos.show', ['id' => $todo->id]));

        $response->assertStatus(Response::HTTP_FOUND);
    }

   
}
