<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_displays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->default('');
            $table->string('link')->default('');
            $table->string('orderby')->default('id');
            $table->integer('order')->default(0);
            $table->integer('count')->default(8);
            $table->integer('home_page_section_id')->unsigned();
            $table->foreign('home_page_section_id')->references('id')->on('home_page_sections')->onDelete('cascade');

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
        Schema::dropIfExists('category_displays');
    }
}
