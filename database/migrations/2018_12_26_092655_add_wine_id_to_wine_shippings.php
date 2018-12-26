<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWineIdToWineShippings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wine_shippings', function (Blueprint $table) {
            $table->integer('wine_id')->unsigned();

            $table->foreign('wine_id')->references('id')->on('wines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wine_shippings', function (Blueprint $table) {
            $table->dropForeign(['wine_id']);
            $table->dropColumn('wine_id');
        });
    }
}
