<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvelopepacketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envelopepackets', function (Blueprint $table) {
            $table->bigIncrements('envelopepacket_ID');
            $table->integer('envelopepacket_ENVELOPE_ID');
            $table->integer('envelopepacket_ORDER');
            $table->integer('envelopepacket_ENVELOPELIST_ID');
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
        Schema::dropIfExists('envelopepackets');
    }
}
