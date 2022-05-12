<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laundry_id');
            $table->boolean('self_service')->nullable();
            $table->boolean('full_service')->nullable();
            $table->boolean('pick_up')->nullable();
            $table->boolean('reservations')->nullable();
            $table->boolean('cash')->nullable();
            $table->boolean('cashless')->nullable();
            $table->string('gcash_qr_code')->nullable();
            $table->boolean('is_published');
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
        Schema::dropIfExists('services');
    }
}
