<?php

namespace Database\Seeders;

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
        $categories = ['категория 1', 'категория 2', 'категория 3'];

        for ($i=0; $i < count($categories); $i++) {
            Category::create([
                'title' => $categories[$i],
            ]);
        }
    }
}
