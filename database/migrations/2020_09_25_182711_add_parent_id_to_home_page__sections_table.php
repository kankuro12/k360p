<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToHomePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_page_sections', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned();
            $table->integer('row')->unsigned()->default(12);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_page_sections', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('row');
        });
    }
}
