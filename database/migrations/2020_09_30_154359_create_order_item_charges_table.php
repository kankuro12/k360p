<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount',8,2)->default(0);
            $table->decimal('title',8,2)->default(0);
            $table->integer('extra_charge_id')->unsigned();
            $table->foreign('extra_charge_id')->references('id')->on('extra_charges')->onDelete('cascade');
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
        Schema::dropIfExists('order_item_charges');
    }
}
