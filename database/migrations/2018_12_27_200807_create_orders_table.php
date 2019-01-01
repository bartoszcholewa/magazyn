<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_ID');
            $table->integer('order_ROLL_ID');
            $table->string('order_NAME');
            $table->date('order_DATE');
            $table->string('order_CLIENT_NAME');
            $table->string('order_CLIENT_SURNAME');
            $table->decimal('order_EXPECTED_L', 8, 2);
            $table->decimal('order_SAFE_L', 8, 2);
            $table->decimal('order_ACTUAR_L', 8, 2);
            $table->longtext('order_DESCRIPTION');
            $table->integer('order_STATUS');
            $table->integer('order_CREATOR_ID');
            $table->integer('order_EDITOR_ID');
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
        Schema::dropIfExists('orders');
    }
}
