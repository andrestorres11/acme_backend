<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token', function (Blueprint $table) {
            $table->increments('token_id');
            $table->unsignedInteger('statu_id')->default('1');
            $table->unsignedInteger('user_id');
            $table->string('token_encrypted', 300);
            $table->dateTime('token_creationDate')->nullable();
            $table->dateTime('token_lastModification')->nullable();
            $table->foreign('statu_id')->references('statu_id')->on('statu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token');
    }
}
