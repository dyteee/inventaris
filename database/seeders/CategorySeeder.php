<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Alat Laboratorium IPA'],
            ['name' => 'Peralatan Multimedia & Audio Visual'],
            ['name' => 'Peralatan Olahraga'],
            ['name' => 'Perlengkapan Sarana & Prasarana'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
