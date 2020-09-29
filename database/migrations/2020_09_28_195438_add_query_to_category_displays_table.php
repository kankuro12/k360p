<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQueryToCategoryDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_displays', function (Blueprint $table) {
            $table->boolean('hasquery')->default(false);
            $table->text('query')->default("");
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
            $table->dropColumn('hasquery');
            $table->dropColumn('query');
        });
    }
}
