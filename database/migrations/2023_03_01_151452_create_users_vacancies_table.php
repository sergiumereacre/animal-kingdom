<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('users_vacancies', function (Blueprint $table) {
            $table->increments('users_vacancies_id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('vacancy_id');
            $table->foreign('vacancy_id')->references('vacancy_id')->on('vacancies');
            $table->dateTime('time_joined');
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
        Schema::dropIfExists('users_vacancies');
    }
}
