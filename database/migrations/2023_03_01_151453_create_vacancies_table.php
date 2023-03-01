<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('vacancies', function (Blueprint $table) {
            $category = array('MAMMAL', 'REPTILE', 'AMPHIBIAN', 'AVIAN', 'FISH');
            $eating_style = array('HERBIVORE', 'CARNIVORE', 'OMNIVORE');

            $table->increments('vacancy_id');
            $table->dateTime('time_created');
            $table->integer('organisation_id')->unsigned();
            $table->foreign('organisation_id')->references('organisation_id')->on('organisations');
            $table->string('vacancy_title');
            $table->text('vacancy_description')->nullable();
            $table->enum('category_requirement', $category)->nullable();
            $table->boolean('can_fly_requirement')->nullable();
            $table->boolean('can_swim_requirement')->nullable();
            $table->enum('eating_style_requirement', $eating_style)->nullable();
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
        Schema::dropIfExists('vacancies');
    }
}
