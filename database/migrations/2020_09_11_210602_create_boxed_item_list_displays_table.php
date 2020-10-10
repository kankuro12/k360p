<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxedItemListDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boxed_item_list_displays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderby')->default('id');
            $table->integer('order')->default(0);
            $table->integer('count')->default(8);
            $table->integer('boxed_item_display_id')->unsigned();
            $table->foreign('boxed_item_display_id')->references('id')->on('boxed_item_displays')->onDelete('cascade');
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
        Schema::dropIfExists('boxed_item_list_displays');
    }
}
