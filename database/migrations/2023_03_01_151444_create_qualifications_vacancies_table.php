<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('qualifications_vacancies', function (Blueprint $table) {
            $table->increments('qualifications_vacancies_id');

            $table->integer('qualification_id')->unsigned();
            $table->foreign('qualification_id')->references('qualification_id')->on('qualifications');
            $table->integer('vacancy_id')->unsigned();
            $table->foreign('vacancy_id')->references('vacancy_id')->on('vacancies');
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
        Schema::dropIfExists('qualifications_vacancies');
    }
}
