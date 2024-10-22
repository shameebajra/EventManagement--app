<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ["email"=> "admin@gmail.com","name"=> "John Doe", "password"=>Hash::make("123456"), "phone_number"=>9849792376, "role_id"=>1,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ["email"=> "vendor@gmail.com","name"=> "Spark Entertainment", "password"=>Hash::make("123456"), "phone_number"=>9841365012, "role_id"=>2,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ["email"=> "user@gmail.com","name"=> "Riri Smith", "password"=>Hash::make("123456"), "phone_number"=>9823456789, "role_id"=>3,'created_at' => Carbon::now(),'updated_at' => Carbon::now()],

        ];
        DB::table('users')->insert($users);
    }
}
