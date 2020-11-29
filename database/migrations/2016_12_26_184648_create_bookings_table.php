<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('completed')->default(0);
            $table->integer('status')->default(0);
            $table->integer('property_id')->index();
            $table->integer('user_id')->index();
            $table->integer('owner_id')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('guest_number');
            $table->integer('total');
            $table->text('user_data');
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
        Schema::dropIfExists('bookings');
    }
}
