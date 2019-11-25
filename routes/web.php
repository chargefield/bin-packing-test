<?php

use App\Order;
use App\Printing\Packer;
use App\Printing\Preview;

Route::get('/', function () {
    $orders = Order::with('items.product')->ordered()->get();

    $packer = new Packer($orders);

    return (new Preview($packer->bins()))->view();
});
