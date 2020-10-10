<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQueryToBoxedItemListDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boxed_item_list_displays', function (Blueprint $table) {
            $table->boolean('hasquery')->default(false);
            $table->boolean('hascategory')->default(false);
            $table->string('query')->default("");
            $table->string('title')->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boxed_item_list_displays', function (Blueprint $table) {
            $table->dropColumn('hasquery');
            $table->dropColumn('title');
            $table->dropColumn('hascategory');
            $table->dropColumn('query');
        });
    }
}
