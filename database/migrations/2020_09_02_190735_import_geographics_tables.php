<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportGeographicsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'countries',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('iso_name')->nullable();
                $table->string('iso')->nullable();
                $table->string('iso3')->nullable();
                $table->string('name')->nullable();
                $table->string('name_en')->nullable();
                $table->string('numcode')->nullable();
                $table->unsignedInteger('region_id')->nullable();
                $table->timestamps();

                $table->index('name');
            }
        );
        
        Schema::create(
            'states',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('country_id')->nullable();
                $table->string('name')->nullable();
                $table->timestamps();

                $table->index('name');
                $table->index('country_id');
            }
        );
            
        Schema::create(
            'cities',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('state_id')->nullable();
                $table->string('name')->nullable();
                $table->timestamps();

                $table->index('name');
                $table->index('state_id');
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
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
    }
}
