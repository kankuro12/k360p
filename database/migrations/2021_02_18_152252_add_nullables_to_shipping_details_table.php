<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullablesToShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_details', function (Blueprint $table) {
            $table->integer('province_id')->unsigned()->nullable()->change();
         

            $table->integer('district_id')->unsigned()->nullable()->change();
     

            $table->integer('municipality_id')->unsigned()->nullable()->change();
          

            $table->integer('shipping_area_id')->unsigned()->nullable()->change();
            $table->text('streetaddress')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_details', function (Blueprint $table) {
            $table->integer('province_id')->unsigned()->change();
         

            $table->integer('district_id')->unsigned()->change();
     

            $table->integer('municipality_id')->unsigned()->change();
          

            $table->integer('shipping_area_id')->unsigned()->change();
            $table->dropColumn('streetaddress');
        });
    }
}
