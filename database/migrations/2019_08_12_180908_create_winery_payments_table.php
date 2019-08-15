<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWineryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winery_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('winery_id')->unsigned()->index();
            $table->integer('merchant_id');
            $table->string('external_merchant_id', 128);
            $table->string('infinicept_application_id', 128);
            $table->timestamps();

            $table->foreign('winery_id')->references('id')->on('wineries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('winery_payments');
    }
}