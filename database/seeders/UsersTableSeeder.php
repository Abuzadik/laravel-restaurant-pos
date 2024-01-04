<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            //admin 
           [
            "name"=> "admin",
            "email"=> "admin@mof.com",
            "password"=> Hash::make("admin123"),
            "role" => "admin",
           ],

             //user 
             [
                "name"=> "user",
                "email"=> "user@mof.com",
                "password"=> Hash::make("user123"),
                "role" => "user",
               ]
        ]);
    }
}
