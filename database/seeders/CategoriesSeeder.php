<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public array $categories = [
        'Elettronica',
        'Motori',
        'Libri',
        'Libri scolastici',
        'Accessori',
    ];

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::firstOrCreate([
                'name' => $category,
            ]);
        }
    }
}
