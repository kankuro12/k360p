<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterlinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footerlinks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('link');
            $table->integer('footerhead_id')->unsigned();
            $table->foreign('footerhead_id')->references('id')->on('footerheads')->onDelete('cascade');
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
        Schema::dropIfExists('footerlinks');
    }
}
