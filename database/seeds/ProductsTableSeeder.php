<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title'  => 'Product 1',
                'width'  => 100,
                'height' => 100,
                'price'  => 10,
                'inventory_quantity' => 5000,
                'design_url' => 'https://via.placeholder.com/150/0000FF/808080%20?text=product1',
            ],
            [
                'title'  => 'Product 2',
                'width'  => 200,
                'height' => 200,
                'price'  => 20,
                'inventory_quantity' => 5000,
                'design_url' => 'https://via.placeholder.com/150/FF0000/808080%20?text=product2',
            ],
            [
                'title'  => 'Product 3',
                'width'  => 300,
                'height' => 300,
                'price'  => 30,
                'inventory_quantity' => 5000,
                'design_url' => 'https://via.placeholder.com/150/000000/808080%20?text=product3',
            ],
            [
                'title'  => 'Product 4',
                'width'  => 400,
                'height' => 400,
                'price'  => 40,
                'inventory_quantity' => 5000,
                'design_url' => 'https://via.placeholder.com/150/FFFFFF/808080%20?text=product4',
            ],
            [
                'title'  => 'Product 5',
                'width'  => 500,
                'height' => 200,
                'price'  => 50,
                'inventory_quantity' => 5000,
                'design_url' => 'https://via.placeholder.com/150/008000/808080%20?text=product5',
            ],
            [
                'title'  => 'Product 6',
                'width'  => 200,
                'height' => 500,
                'price'  => 50,
                'inventory_quantity' => 5000,
                'design_url' => 'https://via.placeholder.com/150/FFFFFF/000000%20?text=product6',
            ],
        ];
 
        foreach ($products as $product)
            DB::table('products')->insert($product);
    }
}