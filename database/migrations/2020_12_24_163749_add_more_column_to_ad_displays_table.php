<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnToAdDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_displays', function (Blueprint $table) {
            $table->string('button_text_color');
            $table->string('button_bg_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_displays', function (Blueprint $table) {
            $table->dropColumn('button_text_color');
            $table->dropColumn('button_bg_color');
        });
    }
}
