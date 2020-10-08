<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExatraChargeCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exatra_charge_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount',8,2)->default(0);
            $table->string('title');
            $table->integer('extra_charge_id')->unsigned();
            $table->foreign('extra_charge_id')->references('id')->on('extra_charges')->onDelete('cascade');
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
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
        Schema::dropIfExists('exatra_charge_carts');
    }
}
