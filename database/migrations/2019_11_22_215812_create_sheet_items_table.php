<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheet_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sheet_id')->index();
            $table->unsignedBigInteger('order_item_id')->index();
            $table->integer('x_pos');
            $table->integer('y_pos');
            $table->integer('width');
            $table->integer('height');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sheet_items');
    }
}
