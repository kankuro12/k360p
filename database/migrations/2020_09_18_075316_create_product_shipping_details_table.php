<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shipping_details', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('weight',8,3);
            $table->decimal('l',8,3);
            $table->decimal('h',8,3);
            $table->decimal('w',8,3);
            $table->integer('product_id')->unsigned();
            $table->integer('shipping_class_id')->unsigned();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('shipping_class_id')->references('id')->on('shipping_classes')->onDelete('cascade');
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
        Schema::dropIfExists('product_shipping_details');
    }
}
