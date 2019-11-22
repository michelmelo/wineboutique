<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWineryShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('winery_shippings', function (Blueprint $table) {
            $table->integer('ship_from')->unsigned()->nullable()->change();
            $table->integer('ship_to')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('winery_shippings', function (Blueprint $table) {
            //
        });
    }
}
