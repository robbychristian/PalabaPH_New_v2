<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laundry_id');
            $table->string('machine_name');
            $table->string('machine_service');
            $table->integer('max_kg');
            $table->integer('timer');
            $table->integer('price');
            $table->boolean('status');
            $table->boolean('is_reserved');
            $table->string('maintenance_date')->nullable();
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
        Schema::dropIfExists('machines');
    }
}
