<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ticket_types')->insert([
            // Tech Conference
            [
                'ticket_type' => 'general',
                'quantity'    => 100,
                'price'       => 150.00,
                'event_id'    => 9,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'ticket_type' => 'VIP',
                'quantity'    => 50,
                'price'       => 300.00,
                'event_id'    => 10,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // Music Fest 2024
            [
                'ticket_type' => 'early_bird',
                'quantity'    => 200,
                'price'       => 100.00,
                'event_id'    => 11,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'ticket_type' => 'student',
                'quantity'    => 300,
                'price'       => 150.00,
                'event_id'    => 12,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // Startup Meetup
            [
                'ticket_type' => 'group',
                'quantity'    => 100,
                'price'       => 50.00,
                'event_id'    => 13,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // Art Exhibition
            [
                'ticket_type' => 'family_pass',
                'quantity'    => 0,
                'price'       => 0.00,
                'event_id'    => 14,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // Health and Wellness Fair
            [
                'ticket_type' => 'general',
                'quantity'    => 100,
                'price'       => 20.00,
                'event_id'    => 15,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // Food Festival
            [
                'ticket_type' => 'sponsorship',
                'quantity'    => 150,
                'price'       => 75.00,
                'event_id'    => 16, 
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // Coding Bootcamp
            [
                'ticket_type' => 'early_bird',
                'quantity'    => 30,
                'price'       => 200.00,
                'event_id'    => 10, // Ensure this event_id exists
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // Book Launch
            [
                'ticket_type' => 'VIP',
                'quantity'    => 50,
                'price'       => 25.00,
                'event_id'    => 9, 
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);
    }
}
