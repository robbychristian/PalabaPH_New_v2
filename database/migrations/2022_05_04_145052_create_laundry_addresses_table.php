<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laundry_id');
            $table->string('street');
            $table->string('state');
            $table->string('barangay');
            $table->string('city');
            $table->string('region');
            $table->timestamps();
            $table->foreign('laundry_id')->references('id')->on('laundries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laundry_addresses');
    }
}
