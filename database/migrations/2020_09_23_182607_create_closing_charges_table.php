<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closing_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('min',10,3);
            $table->decimal('max',10,3);
            $table->decimal('amount',10,3);
            $table->integer('type')->default(0);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('cat_id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('closing_charges');
    }
}
