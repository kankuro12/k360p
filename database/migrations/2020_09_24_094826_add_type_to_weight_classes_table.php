<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToWeightClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weight_classes', function (Blueprint $table) {
            $table->integer('weight_class_type_id')->unsigned();
            $table->foreign('weight_class_type_id')->references('id')->on('weight_class_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weight_classes', function (Blueprint $table) {
            //
        });
    }
}
