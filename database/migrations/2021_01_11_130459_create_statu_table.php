<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statu', function (Blueprint $table) {
            $table->increments('statu_id');
            $table->string('statu_name', 50);
            $table->string('statu_encrypted', 350);
            $table->dateTime('statu_creationDate')->nullable();
            $table->dateTime('statu_lastModification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statu');
    }
}
