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
        foreach(range(1, 10) as $index) {
            \App\Models\Category::create([
                'nome' => "Category {$index}" . \Str::random(4),
            ]);
        }
    }
}
