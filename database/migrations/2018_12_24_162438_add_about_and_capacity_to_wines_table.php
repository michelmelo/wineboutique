<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAboutAndCapacityToWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wines', function (Blueprint $table) {
            $table->string('who_made_it');
            $table->string('when_was_it_made');
            $table->string('capacity');
            $table->integer('unit_id')->unsigned()->index()->nullable();

            $table->foreign('unit_id')->references('id')->on('capacity_units')->onDelete('cascade');
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
            $table->dropForeign(['unit_id']);
            $table->dropColumn('who_made_it', 'when_was_it_made', 'capacity', 'unit_id');
        });
    }
}
