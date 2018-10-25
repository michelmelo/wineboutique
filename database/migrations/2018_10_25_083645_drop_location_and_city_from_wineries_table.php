<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLocationAndCityFromWineriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wineries', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['location_id']);
            $table->dropColumn(['city_id', 'location_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wineries', function (Blueprint $table) {
            $table->integer('city_id')->unsigned()->index()->nullable();
            $table->integer('location_id')->unsigned()->index()->nullable();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }
}
