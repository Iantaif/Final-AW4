<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
  
    public function definition(): array
    {
        $category = DB::table('categories')->inRandomOrder()->first();

        return [
            'user_id'=> auth()->user(),
            'category_id' => $category ? $category->id : null,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_completed' =>  $this->faker->boolean, 
        ];
    }
}
