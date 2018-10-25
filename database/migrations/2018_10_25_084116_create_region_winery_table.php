<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionWineryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_winery', function (Blueprint $table) {
            $table->integer('region_id')->unsigned()->index();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');

            $table->integer('winery_id')->unsigned()->index();
            $table->foreign('winery_id')->references('id')->on('wineries')->onDelete('cascade');

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
        Schema::dropIfExists('region_winery');
    }
}
