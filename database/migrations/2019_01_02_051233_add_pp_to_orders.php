<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPpToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('order_pp_ID');
            $table->integer('order_pp_ORDER');
            $table->integer('order_pp_PEDIOD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_pp_ID');
            $table->dropColumn('order_pp_ORDER');
            $table->dropColumn('order_pp_PEDIOD');
        });
    }
}
