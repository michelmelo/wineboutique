<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerPreregistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_preregistrations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('firstName');
            $table->string('lastName');
            $table->string('companyName');
            $table->string('email');
            $table->string('phone');
            $table->string('job')->nullable();
            $table->integer('brands');
            $table->string('licences')->nullable();
            $table->boolean('shipping');

            $table->string('status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_preregistrations');
    }
}
