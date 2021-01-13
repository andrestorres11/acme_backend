<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car', function (Blueprint $table) {
            $table->increments('car_id');
            $table->unsignedInteger('statu_id')->default('1');
            $table->unsignedInteger('user_id');
            $table->string('car_licensePlate', 50);
            $table->string('car_color', 100);
            $table->string('car_type', 50);
            $table->string('car_brand', 50);
            $table->string('car_encrypted', 300);
            $table->dateTime('car_creationDate');
            $table->dateTime('car_lastModification')->nullable();
            $table->foreign('statu_id')->references('statu_id')->on('statu');
            $table->foreign('user_id')->references('user_id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car');
    }
}
