<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public array $categories = [
        'Elettronica',
        'Motori',
        'Libri scolastici',
        'Accessori',
        'Abbigliamento sportivo',
        'Biciclette',
        'Articoli per animali',
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
