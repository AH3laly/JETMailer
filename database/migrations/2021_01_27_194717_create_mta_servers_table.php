<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtaServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mta_servers', function (Blueprint $table) {
            $table->id();
            $table->string('host', 255);
            $table->string('port', 3);
            $table->string('security', 4); // none | ssl | tls
            $table->string('username');
            $table->string('password');
            $table->integer('failures');
            $table->integer('enabled')->index();
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
        Schema::dropIfExists('mta_servers');
    }
}
