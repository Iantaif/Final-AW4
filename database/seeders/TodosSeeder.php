<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Todo::factory()->count(30)->create();
        $user = User::first(); // Lấy ra một user từ database

        DB::table('todos')->insert([
            'user_id' => $user->id,
            'title' => 'Sample Todo 1',
            'description' => 'This is a sample todo description.',
            'is_completed' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('todos')->insert([
            'user_id' => $user->id,
            'title' => 'Sample Todo 2',
            'description' => 'Another sample todo description.',
            'is_completed' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('todos')->insert([
            'user_id' => $user->id,
            'title' => 'Sample Todo 3',
            'description' => 'Yet another sample todo description.',
            'is_completed' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
