<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['nome' => 'Categoria 1'],
            ['nome' => 'Categoria 2'],
            ['nome' => 'Categoria 3'],
            ['nome' => 'Categoria 4'],
            ['nome' => 'Categoria 5'],
        ];

        foreach($categories as $category)
        {
            \App\Models\Category::updateOrCreate(
                ['nome' => $category['nome']],
                $category
            );
        }
    }
}
