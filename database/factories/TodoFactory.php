<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{

    public function definition(): array
    {

        $user_id = Auth::id();

        // Chọn ngẫu nhiên một category thuộc user hiện tại
$category = Category::where('user_id', auth()->id())->inRandomOrder()->first();

        return [
            'user_id' => $user_id,
            'category_id' => $category ? $category->id : null,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'is_completed' => $this->faker->boolean,
        ];
    }
}
