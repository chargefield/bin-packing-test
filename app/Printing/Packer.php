<?php

namespace App\Printing;

use App\Order;
use App\Sheet;
use App\Product;
use App\OrderItem;
use Illuminate\Support\Collection;

class Packer
{
    protected $orders;

    protected $bins;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
        $this->bins = new Bins;
    }

    /**
     * Create preview.
     *
     * @return \App\Printing\Preview
     */
    public function preview(): Preview
    {
        return new Preview($this->bins());
    }

    /**
     * Get bins.
     *
     * @return \App\Printing\Bins
     */
    public function bins(): Bins
    {
        $this->orders->each(function (Order $order) {
            $this->bins->add(Sheet::MAX_WIDTH, Sheet::MAX_HEIGHT, $this->getItemsFor($order));
        });

        return $this->bins;
    }

    /**
     * Get items for a given order.
     *
     * @param \App\Order $order
     * @return \Illuminate\Support\Collection
     */
    protected function getItemsFor(Order $order): Collection
    {
        return $order->items
            ->map(function (OrderItem $item) {
                return $item->products()
                    ->map(function (Product $product) use ($item) {
                        return new Item($product, $item);
                    })
                    ->toArray();
            })
            ->flatten();
    }
}
