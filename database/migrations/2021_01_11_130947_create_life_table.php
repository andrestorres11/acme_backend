<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('life', function (Blueprint $table) {
            $table->increments('life_id');
            $table->unsignedInteger('statu_id')->default('1');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('car_id');
            $table->string('life_encrypted', 350);
            $table->dateTime('life_creationDate');
            $table->dateTime('life_lastModification')->nullable();
            $table->foreign('statu_id')->references('statu_id')->on('statu');
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('car_id')->references('car_id')->on('car');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('life');
    }
}
