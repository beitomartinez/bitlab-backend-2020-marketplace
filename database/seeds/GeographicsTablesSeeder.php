<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeographicsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(
            file_get_contents('database/dumps/geographics.sql')
        );
    }
}
