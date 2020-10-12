<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDeliveryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_images', function (Blueprint $table) {
            $table->drop();
        });
        Schema::create('delivery_images', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->integer('shipping_detail_id')->unsigned();
            $table->foreign('shipping_detail_id')->references('id')->on('shipping_details')->onDelete('cascade');
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
        Schema::table('delivery_images', function (Blueprint $table) {
            $table->drop();
        });
        Schema::create('delivery_images', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->integer('order_item_id')->unsigned();
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->timestamps();
        });
    }
}
