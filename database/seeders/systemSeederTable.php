<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class systemSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("systems")->insert([
            // system detail 
            [
                "name"=> "GST POS",
                "address"=> "Road no.1",
                "telephone"=> "000111222",
            ]
        ]);
    }
}
