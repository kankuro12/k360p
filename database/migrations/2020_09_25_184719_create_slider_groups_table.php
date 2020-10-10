<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
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
        Schema::dropIfExists('slider_groups');
    }
}
