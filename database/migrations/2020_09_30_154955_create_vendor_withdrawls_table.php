<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorWithdrawlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_withdrawls', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount',8,2)->default(0);
            $table->integer('stage')->default(0);
            $table->date('requesteddate');
            $table->date('accecpteddate')->nullable();
            $table->date('completeddate')->nullable();
            $table->string('paymentdetails')->default('');
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
        Schema::dropIfExists('vendor_withdrawls');
    }
}
