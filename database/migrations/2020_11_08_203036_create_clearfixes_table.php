<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearfixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearfixes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('Some special product are onsale for certain time.');
            $table->string('link_title')->default('Shop Now');
            $table->string('link')->default('/shops');
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
        Schema::dropIfExists('clearfixes');
    }
}
