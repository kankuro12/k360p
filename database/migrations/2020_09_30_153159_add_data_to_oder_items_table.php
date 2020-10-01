<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToOderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('shippingcharge',8,2)->default(0);
            $table->integer('stage')->default(0);
            $table->boolean('ismainstore')->default(false);
            $table->boolean('issimple')->default(true);
            
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
            //
            $table->dropColumn('shippingcharge');
            $table->dropColumn('stage');
            $table->dropColumn('ismainstore');
            $table->dropColumn('issimple');
        });
    }
}
