<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKopertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koperty', function (Blueprint $table) {
            $table->bigIncrements('koperty_ID');
            $table->string('koperty_NAME');
            $table->string('koperty_COMPANY');
            $table->string('koperty_PERSON');
            $table->string('koperty_STREET');
            $table->string('koperty_ZIPCODE');
            $table->string('koperty_CITY');
            $table->string('koperty_COUNTRY');
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
        Schema::dropIfExists('koperty');
    }
}
