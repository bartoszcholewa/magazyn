<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolls', function (Blueprint $table) {
            $table->increments('roll_ID');
            $table->integer('roll_MATERIAL_ID');
            $table->string('roll_NAME');
            $table->date('roll_DATE');
            $table->string('roll_INVOICE_NR');
            $table->string('roll_INVOICE_FILE');
            $table->integer('roll_INVOICE_STATUS');
            $table->longtext('roll_DESCRIPTION');
            $table->integer('roll_STATUS');
            $table->boolean('roll_DEFECTED');
            $table->decimal('roll_LENGTH', 8, 2);
            $table->integer('roll_CREATOR');
            $table->integer('roll_EDITOR');
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
        Schema::dropIfExists('rolls');
    }
}
