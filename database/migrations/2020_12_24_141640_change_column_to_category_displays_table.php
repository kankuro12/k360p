<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToCategoryDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_displays', function (Blueprint $table) {
            $table->decimal('mobile',8,2)->change();
            $table->decimal('tab',8,2)->change();
            $table->decimal('laptop',8,2)->change();
            $table->decimal('tv',8,2)->change();
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
