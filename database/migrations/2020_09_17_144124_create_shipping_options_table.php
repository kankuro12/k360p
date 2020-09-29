<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier');
            $table->decimal('minweight', 8,3);
            $table->decimal('maxweight', 8,3);
            $table->decimal('amount', 8,3);
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
        Schema::dropIfExists('shipping_options');
    }
}
