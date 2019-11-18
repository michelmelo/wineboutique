<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorOrderWineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_wines', function (Blueprint $table) {
            $table->integer('winery_id')->after("wine_id");
            $table->string('wine_name', 128)->after("quantity");
            $table->double('price', 8,2)->after("wine_name");
            $table->double('shipping_price', 8,2)->after("price");
            $table->double('additional_shipping_price', 8,2)->after("shipping_price");
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
