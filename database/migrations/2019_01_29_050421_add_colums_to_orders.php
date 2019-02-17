<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->longtext('order_URL');
            $table->integer('order_EFFECTS');
            $table->integer('order_ROTATION');
            $table->string('order_FLIP_X');
            $table->string('order_FLIP_Y');
            $table->integer('order_OVERLAP');
            $table->integer('order_LAMINATE');
            $table->integer('order_GLUE');
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
            $table->dropColumn('order_URL');
            $table->dropColumn('order_EFFECTS');
            $table->dropColumn('order_ROTATION');
            $table->dropColumn('order_FLIP_X');
            $table->dropColumn('order_FLIP_Y');
            $table->dropColumn('order_OVERLAP');
            $table->dropColumn('order_LAMINATE');
            $table->dropColumn('order_GLUE');
        });
    }
}
