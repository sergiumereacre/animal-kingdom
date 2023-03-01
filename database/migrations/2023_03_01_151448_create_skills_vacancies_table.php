<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('skills_vacancies', function (Blueprint $table) {
            $table->integer('skills_vacancies_id')->primary();
            $table->increments('skill_id')->nullable();
            $table->foreign('skill_id')->references('skill_id')->on('skills');
            $table->integer('vacancy_id');
            $table->foreign('vacancy_id')->references('vacancy_id')->on('vacancies');
            $table->enum('skill_level')->nullable();
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
        Schema::dropIfExists('skills_vacancies');
    }
}
