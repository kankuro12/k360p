<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderItemIdToOrderItemChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item_charges', function (Blueprint $table) {
            //
            $table->integer('order_item_id')->unsigned();
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item_charges', function (Blueprint $table) {
            //
            $table->dropColumn('order_item_id');
        });
    }
}
