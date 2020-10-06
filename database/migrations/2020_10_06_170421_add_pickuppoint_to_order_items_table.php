<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickuppointToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->integer('pickup_point_id')->nullable()->unsigned();
            $table->foreign('pickup_point_id')->references('id')->on('pickup_points')->onDelete('cascade');
            $table->dateTime('pickup_point_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['pickup_point_id']);
            $table->dropColumn('pickup_point_id');
            $table->dropColumn('pickup_point_time');
        });
    }
}
