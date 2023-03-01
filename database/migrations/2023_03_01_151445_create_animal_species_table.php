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
            $table->integer('species_id')->primary();
            $table->string('species_name');
            $table->enum('category');
            $table->boolean('can_fly');
            $table->boolean('can_swim');
            $table->enum('eating_style');
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
