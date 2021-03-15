<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateMobileSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_sliders', function (Blueprint $table) {
            $table->id();
            $table->integer('home_page_section_id')->unsigned();
            $table->foreign('home_page_section_id')->references('id')->on('home_page_sections')->onDelete('cascade');
            $table->text('image')->nullable();
            $table->boolean('active')->default(true);
            $table->text('link')->nullable();
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
        Schema::dropIfExists('mobile_sliders');
    }
}
