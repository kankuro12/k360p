<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_groups', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->integer('type')->default(0);
            $table->decimal('per')->default(0);
            $table->decimal('flat')->default(0);
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('shipping_groups');
    }
}
