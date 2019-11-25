<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('products')->insert($this->getProducts());
    }

    /**
     * Get products
     *
     * @return array
     */
    protected function getProducts(): array
    {
        return [
            ['title' => 'Product 1', 'size' => '1x1', 'color' => 'B71C1C', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Product 2', 'size' => '2x2', 'color' => '4A148C', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Product 3', 'size' => '3x3', 'color' => '0D47A1', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Product 4', 'size' => '1x1', 'color' => '006064', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Product 5', 'size' => '4x4', 'color' => '1B5E20', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Product 6', 'size' => '5x2', 'color' => 'FF6F00', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Product 7', 'size' => '2x5', 'color' => '3E2723', 'created_at' => now(), 'updated_at' => now()],
        ];
    }
}
