<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('category_id')->index();
            $table->integer('type_id')->nullable();
            $table->integer('location_id')->index();
            $table->integer('status')->default(0);
            $table->integer('featured')->default(0);
            $table->text('location');
            $table->string('features')->nullable();
            $table->string('prices')->nullable();
            $table->string('fees')->nullable();
            $table->integer('price_per_night')->default(0)->nullable();
            $table->integer('guest_number')->default(0)->nullable();
            $table->integer('rooms')->default(0)->nullable();
            $table->string('property_info')->nullable();
            $table->text('contact')->nullable();
            $table->text('social')->nullable();
            $table->text('video')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('alias');
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
        Schema::dropIfExists('properties');
    }
}
