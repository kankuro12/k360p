<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatioToCategoryDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_displays', function (Blueprint $table) {
            $table->integer('mobile')->default(1);
            $table->integer('tab')->default(2);
            $table->integer('laptop')->default(3);
            $table->integer('tv')->default(5);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_displays', function (Blueprint $table) {
            $table->dropColumn('mobile');
            $table->dropColumn('tab');
            $table->dropColumn('laptop');
            $table->dropColumn('tv');
        });
    }
}
