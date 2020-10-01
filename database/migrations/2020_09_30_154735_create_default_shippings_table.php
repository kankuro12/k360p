<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_shippings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('province_id')->unsigned();
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');

            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');

            $table->integer('municipality_id')->unsigned();
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');

            $table->integer('shipping_area_id')->unsigned();
            $table->foreign('shipping_area_id')->references('id')->on('shipping_areas')->onDelete('cascade');

            $table->boolean('isdefault')->default(true);
            
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
        Schema::dropIfExists('default_shippings');
    }
}
