<?php

use App\Order;
use App\Printing\Packer;

Route::get('/', function () {
    $orders = Order::with('items.product')->ordered()->get();

    $packer = new Packer($orders);

    return $packer->preview()->view();
});
