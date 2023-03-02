<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id($column = 'user_id');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->boolean('is_admin')->default(false);
            $table->integer('species_id')->unsigned();
            $table->foreign('species_id')->references('species_id')->on('animal_species');
            $table->string('address')->nullable();
            $table->date('date_of_birth');
            $table->integer('organisation_id')->unsigned();
            $table->foreign('organisation_id')->references('organisation_id')->on('organisations');
            $table->string('contact_number')->nullable();
            $table->boolean('is_banned')->default(false);
            $table->text('bio')->nullable();

            // $table->increments('user_id');
            // $table->boolean('is_admin')->default(false);
            // $table->integer('species_id');
            // $table->foreign('species_id')->references('species_id')->on('animal_species');
            // $table->string('username');
            // $table->string('password');
            // $table->string('email');
            // $table->string('address')->nullable();
            // $table->date('date_of_birth');
            // $table->integer('organisation_id');
            // $table->foreign('organisation_id')->references('organisation_id')->on('organisations');
            // $table->string('contact_number')->nullable();
            // $table->boolean('is_banned')->default(false);
            // $table->text('bio')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
