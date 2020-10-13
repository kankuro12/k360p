<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStyleToCategoryDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_displays', function (Blueprint $table) {
            $table->integer('displaytype')->default('0');
            $table->text('extrastyle')->nullable();
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
            $table->dropColumn('displaytype');
            $table->dropColumn('extrastyle');
        });
    }
}
