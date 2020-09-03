<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'businesses',
            function (Blueprint $table) {
                $table->id();
                $table->string('names')->index();
                $table->string('slug');
                $table->string('image');
                $table->text('description');
                $table->string('phone')->nullable();
                $table->string('whatsapp')->nullable();
                $table->string('email')->nullable();
                $table->string('website')->nullable();
                $table->string('address');
                $table->unsignedInteger('state_id')->index();
                $table->unsignedInteger('city_id')->index();
                $table->boolean('is_delivery')->default(0);
                $table->boolean('is_takeout')->default(0);
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('category_id');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('state_id')->references('id')->on('states');
                $table->foreign('city_id')->references('id')->on('cities');
                $table->foreign('user_id')->references('id')->on('users');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}