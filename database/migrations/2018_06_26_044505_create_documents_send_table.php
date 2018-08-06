<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsSendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_send', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('requested_by');
            $table->integer('submitted_to');
            $table->integer('send_to');
            $table->string('letter_number');
            $table->string('approval_status');
            $table->string('note');
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
        Schema::dropIfExists('documents_send');
    }
}
