<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'schedules',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('business_id');
                $table->enum('day', ['m', 't', 'w', 'r', 'f', 's', 'u']);
                $table->time('opens_at');
                $table->time('closes_at');
                $table->timestamps();
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
        Schema::dropIfExists('schedules');
    }
}
