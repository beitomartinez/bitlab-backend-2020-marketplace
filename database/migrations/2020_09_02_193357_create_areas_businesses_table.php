<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'areas_businesses',
            function (Blueprint $table) {
                $table->unsignedBigInteger('business_id');
                $table->unsignedBigInteger('areas_id');

                $table->unique(['business_id', 'areas_id']);
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
        Schema::dropIfExists('areas_businesses');
    }
}
