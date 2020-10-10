<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_displays', function (Blueprint $table) {
            $table->increments('id');
            $table->text('tag');
            $table->text('title');
            $table->string('orderby')->default('id');
            $table->integer('order')->default(0);
            $table->integer('count')->default(8);
            $table->integer('home_page_section_id')->unsigned();
            $table->foreign('home_page_section_id')->references('id')->on('home_page_sections')->onDelete('cascade');
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
        Schema::dropIfExists('tag_displays');
    }
}
