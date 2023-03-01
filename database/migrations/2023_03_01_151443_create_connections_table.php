<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('connections', function (Blueprint $table) {
            $table->integer('connection_id')->primary();
            $table->integer('first_user_id');
            $table->foreign('first_user_id')->references('user_id')->on('users');
            $table->integer('second_user_id');
            $table->foreign('second_user_id')->references('user_id')->on('users');
            $table->dateTime('time_created');
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
        Schema::dropIfExists('connections');
    }
}
