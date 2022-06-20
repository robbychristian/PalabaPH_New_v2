<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("laundry_id");
            $table->unsignedBigInteger("user_id");
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("last_name");
            $table->string("total_price");
            $table->string("mode_of_payment");
            $table->string("commodity_type");
            $table->string("segregation_type");
            $table->string("status");
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
        Schema::dropIfExists('mobile_orders');
    }
}
