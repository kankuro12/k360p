<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleTagDisplayItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_tag_display_items', function (Blueprint $table) {
            $table->increments('id');
           
            $table->text('orderby')->default('id');
            $table->integer('order')->default(0);
            $table->integer('count')->default(8);
            $table->text('tag');
            
            $table->integer('home_page_section_id')->unsigned();
            $table->foreign('home_page_section_id')->references('id')->on('home_page_sections')->onDelete('cascade');
            $table->integer('multiple_tag_display_id')->unsigned();
            $table->foreign('multiple_tag_display_id')->references('id')->on('multiple_tag_displays')->onDelete('cascade');
            
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
        Schema::dropIfExists('multiple_tag_display_items');
    }
}
