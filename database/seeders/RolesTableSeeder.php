<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles you want to insert with explicit IDs
        $roles = [
            ['id' => 1, 'role_name' => 'Super Admin'],
            ['id' => 2, 'role_name' => 'Vendor'],
            ['id' => 3, 'role_name' => 'User'], // or 'Regular User', if you prefer
        ];

        // Insert roles into the database
        DB::table('roles')->insert($roles);
    }
}
 