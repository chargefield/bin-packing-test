<?php

namespace App\Printing;

use App\Order;
use App\Sheet;
use App\Printing\Item;
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

    public function bins(): Bins
    {
        $this->orders->each(function (Order $order) {
            $this->bins->add(Sheet::MAX_WIDTH, Sheet::MAX_HEIGHT, $this->getItemsFor($order));
        });

        return $this->bins;
    }

    protected function getItemsFor(Order $order): Collection
    {
        return $order->items
            ->map(function ($item) {
                return $item->products()
                    ->map(function ($product) use ($item) {
                        return new Item($product, $item);
                    })
                    ->toArray();
            })
            ->flatten();
    }
}
