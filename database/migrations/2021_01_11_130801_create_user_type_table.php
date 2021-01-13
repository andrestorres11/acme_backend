<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type', function (Blueprint $table) {
            $table->increments('userType_id');
            $table->unsignedInteger('statu_id')->default('1');
            $table->string('userType_name', 300);
            $table->string('userType_encrypted', 300);
            $table->dateTime('userType_creationDate')->nullable();
            $table->dateTime('userType_lastModification')->nullable();
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
        Schema::dropIfExists('user_type');
    }
}
