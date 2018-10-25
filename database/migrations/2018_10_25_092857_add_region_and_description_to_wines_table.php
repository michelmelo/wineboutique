<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegionAndDescriptionToWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wines', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->integer('region_id')->unsigned()->index()->nullable();

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wines', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn(['region_id', 'description']);
        });
    }
}
