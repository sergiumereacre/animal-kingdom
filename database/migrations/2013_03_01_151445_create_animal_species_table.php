<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalSpeciesTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::disableForeignKeyConstraints();

        Schema::create('animal_species', function (Blueprint $table) {
            $category = array('MAMMAL', 'REPTILE', 'AMPHIBIAN', 'AVIAN', 'FISH');
            $eating_style = array('HERBIVORE', 'CARNIVORE', 'OMNIVORE');

            $table->increments('species_id');
            $table->string('species_name');
            $table->enum('category', $category);
            $table->boolean('can_fly');
            $table->boolean('can_swim');
            $table->enum('eating_style', $eating_style);
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
        Schema::dropIfExists('animal_species');
    }
}
