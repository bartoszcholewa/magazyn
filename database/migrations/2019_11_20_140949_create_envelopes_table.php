<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvelopesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envelopes', function (Blueprint $table) {
            $table->bigIncrements('envelope_ID');
            $table->string('envelope_NAME');
            $table->string('envelope_COMPANY');
            $table->string('envelope_PERSON');
            $table->string('envelope_STREET');
            $table->string('envelope_ZIPCODE');
            $table->string('envelope_CITY');
            $table->string('envelope_COUNTRY');
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
        Schema::dropIfExists('envelopes');
    }
}
