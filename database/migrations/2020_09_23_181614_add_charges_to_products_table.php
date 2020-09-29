<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChargesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->decimal('referalcharge',10,3)->default(0);
            $table->decimal('closingcharge',10,3)->default(0);
            $table->decimal('packagingcharge',10,3)->default(0);
            $table->integer('packagingtype')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn('referalcharge');
            $table->dropColumn('closingcharge');
            $table->dropColumn('packagingcharge');
            $table->dropColumn('packagingtype');
        });
    }
}
