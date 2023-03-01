<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('skills_users', function (Blueprint $table) {
            $skill_level = array('BEGINNER', 'INTERMEDIATE', 'EXPERT');

            $table->increments('skills_users_id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('skill_id')->on('skills');
            $table->enum('skill_level', $skill_level)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills_users');
    }
}
