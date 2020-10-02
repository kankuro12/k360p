<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');
            $table->integer('brand_id')->nullable();
            $table->string('product_name');
            $table->text('product_description');
            $table->text('product_short_description');
            $table->boolean('isverified')->nullable();
            $table->string('product_sku')->nullable();
            $table->string('status')->nullable();
            $table->integer('stocktype')->default();
            $table->text('product_images')->nullable();
            $table->float('mark_price')->nullable();
            $table->float('sell_price')->nullable();
            $table->tinyInteger('promo')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->integer('quantity')->nullable();
            $table->integer('vendor_id')->default(0);
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
        Schema::dropIfExists('products');
    }
}
