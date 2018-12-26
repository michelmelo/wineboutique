<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWineShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->string('from');
            $table->string('to');
            $table->boolean('day_week');
            $table->string('destination');
            $table->double('price', 8, 6)->nullable();
            $table->double('additional', 8, 6)->nullable();
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
        Schema::dropIfExists('wine_shippings');
    }
}
