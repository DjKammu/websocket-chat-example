<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('country')->nullable();
            $table->bigInteger('number')->nullable();
            $table->date('dob')->nullable();
            $table->text('languages')->nullable();
            $table->string('currency')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('breast_size')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('desirable_amount')->nullable();
            $table->longText('about_me')->nullable();
            $table->boolean('medical_checkup')->nullable();
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
        Schema::dropIfExists('users_info');
    }
}
