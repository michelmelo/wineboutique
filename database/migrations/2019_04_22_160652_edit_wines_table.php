<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //disabling nullable option for the row 'name'
        Schema::table('wines', function (Blueprint $table) {
            $table->string('name')->change();
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
            $table->string('name')->nullable()->change();
        });
    }
}
