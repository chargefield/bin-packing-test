<?php

use App\Order;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    protected $order_count = 50;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->truncate();
        DB::table('order_items')->truncate();

        Collection::times($this->order_count, function () {
            $order = Order::create();

            $order->items()->createMany($this->getRandomProducts());
        });
    }

    /**
     * Get random products
     *
     * @return array
     */
    protected function getRandomProducts(): array
    {
        $products = Product::get();

        return $products
            ->shuffle()
            ->take(random_int(1, $products->count()))
            ->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'quantity' => random_int(1, 5),
                ];
            })
            ->toArray();
    }
}
