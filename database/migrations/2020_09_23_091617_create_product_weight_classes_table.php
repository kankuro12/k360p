<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWeightClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_weight_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount_0',10,2)->default(0);
            $table->decimal('amount_1',10,2)->default(0);
            $table->decimal('amount_2',10,2)->default(0);
            $table->decimal('amount_3',10,2)->default(0);
            $table->decimal('amount_4',10,2)->default(0);
            $table->string('type_0')->default('s101');
            $table->string('type_1')->default('s101');
            $table->string('type_2')->default('s101');
            $table->string('type_3')->default('s101');
            $table->string('type_4')->default('s101');
            $table->integer('shipping_class_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('shipping_class_id')->references('id')->on('shipping_classes')->onDelete('cascade');
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
        Schema::dropIfExists('product_weight_classes');
    }
}
