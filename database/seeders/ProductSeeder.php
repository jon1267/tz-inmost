<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'Наименование товара 1', 'Наименование товара 2', 'Наименование товара 3',
            'Наименование товара 4', 'Наименование товара 5', 'Наименование товара 6',
            'Наименование товара 7', 'Наименование товара 8', 'Наименование товара 9',
        ];

        $prices = [ 18000, 21000, 12500, 29900, 19900, 14500, 9500, 8500, 5200 ];

        for ($i=0; $i < count($products); $i++) {
            Product::create([
                'title' => $products[$i],
                'price' => $prices[$i],
            ]);
        }
    }
}
