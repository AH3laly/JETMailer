<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAndRecreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mails');

        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fromName', 100);
            $table->string('fromEmail', 255);
            $table->string('toEmail', 255);
            $table->string('subject', 100);
            $table->text('body');
            $table->string('status',20);
            $table->string('format',10);
            $table->boolean('isHtml');
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
        //
    }
}
