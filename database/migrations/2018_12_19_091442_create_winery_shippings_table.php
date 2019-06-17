<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWineryShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('winery_shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('winery_id')->unsigned();
            $table->integer('ship_from')->unsigned();
            $table->integer('ship_to')->unsigned();
            $table->string('days_from');
            $table->string('days_to');
            $table->double('price', 8, 6)->nullable();
            $table->double('additional', 8, 6)->nullable();
            $table->timestamps();

            $table->foreign('winery_id')->references('id')->on('wineries')->onDelete('cascade');
            $table->foreign('ship_from')->references('id')->on('regions')->onDelete('cascade');
            $table->foreign('ship_to')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('winery_shippings');
    }
}
