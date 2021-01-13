<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->unsignedInteger('statu_id')->default('1');
            $table->unsignedInteger('userType_id');
            $table->unsignedInteger('user_identity');
            $table->string('user_name', 50);
            $table->string('user_secName', 100)->nullable();
            $table->string('user_lastName', 50);
            $table->string('user_cellphone', 50);
            $table->string('user_city', 100);
            $table->string('user_address', 350);
            $table->string('user_password', 350);
            $table->string('user_email', 50);
            $table->string('user_encrypted', 300);
            $table->dateTime('user_creationDate');
            $table->dateTime('user_lastModification')->nullable();
            $table->foreign('statu_id')->references('statu_id')->on('statu');
            $table->foreign('userType_id')->references('userType_id')->on('user_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
