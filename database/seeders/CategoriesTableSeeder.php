<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create();
        
        DB::table('categories')->insert([
            ['user_id' => $user->id, 'name' => 'Home'],
            ['user_id' => $user->id, 'name' => 'Work'],
            ['user_id' => $user->id, 'name' => 'School'],
            ['user_id' => $user->id, 'name' => 'Test Category'], 
        ]);
    }
}
