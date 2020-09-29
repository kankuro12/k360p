<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('deliver_range')->default(0);
            $table->decimal('min',10,3);
            $table->decimal('max',10,3);
            $table->decimal('amount',10,3);
            $table->integer('category_id')->unsigned();
            $table->integer('shipping_class_id')->unsigned();
            $table->foreign('shipping_class_id')->references('id')->on('shipping_classes')->onDelete('cascade');
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
        Schema::dropIfExists('weight_classes');
    }
}
