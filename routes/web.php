<?php

use App\Order;
use App\Printing\Packer;
use App\Printing\Preview;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $orders = Order::with('items.product')->ordered()->get();

    $packer = new Packer($orders);

    return (new Preview($packer->bins()))->view();
});
