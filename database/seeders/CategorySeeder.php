<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['id' => 1, 'name' => 'Furniture'],
            ['id' => 2, 'name' => 'Art'],
            ['id' => 3, 'name' => 'Antiques'],
        ]);
    }
}
