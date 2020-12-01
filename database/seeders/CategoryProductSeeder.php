<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Product::all() as $product) {
            $categories = Category::inRandomOrder()->take(rand(2,3))->pluck('id');
            $product->categories()->attach($categories);
        }

    }
}
