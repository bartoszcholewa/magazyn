<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('supplier_ID');
            $table->string('supplier_NAME');
            $table->string('supplier_ADDRESS');
            $table->string('supplier_PHONE');
            $table->string('supplier_EMAIL');
            $table->string('supplier_URL');
            $table->longText('supplier_DESCRIPTION');
            $table->string('supplier_REP_NAME');
            $table->string('supplier_REP_PHONE');
            $table->string('supplier_REP_EMAIL');
            $table->integer('supplier_CREATOR_ID');
            $table->integer('supplier_EDITOR_ID');
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
        Schema::drop('suppliers');
    }
}
