<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $categories = array(
            ['name' => 'Brinquedos', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Casa', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Carro', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Livros', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Tecnologia', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Saúde', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Outros', 'created_at' => now(), 'updated_at' => now(),],
        );

        Category::insert($categories);

    }
}
