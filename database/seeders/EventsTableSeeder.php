<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'event_name'    => 'Tech Conference',
                'event_type'    => 'Conference',
                'event_details' => 'A gathering of tech enthusiasts to discuss trends.',
                'location'      => 'New York',
                'venue'         => 'NYC Convention Center',
                'date'          => '2024-11-15',
                'time'          => '10:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'No refund on cancellation.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'event_name'    => 'Music Fest 2024',
                'event_type'    => 'Festival',
                'event_details' => 'An outdoor music festival with various bands.',
                'location'      => 'Los Angeles',
                'venue'         => 'LA Park',
                'date'          => '2024-12-05',
                'time'          => '18:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'Tickets are non-transferable.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'event_name'    => 'Startup Meetup',
                'event_type'    => 'Meetup',
                'event_details' => 'A networking event for startups and investors.',
                'location'      => 'San Francisco',
                'venue'         => 'SF Startup Hub',
                'date'          => '2025-01-20',
                'time'          => '14:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'Free entry for students.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'event_name'    => 'Art Exhibition',
                'event_type'    => 'Exhibition',
                'event_details' => 'A showcase of local artists and their work.',
                'location'      => 'Chicago',
                'venue'         => 'Art Gallery',
                'date'          => '2024-11-25',
                'time'          => '16:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'Free entry.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'event_name'    => 'Health and Wellness Fair',
                'event_type'    => 'Fair',
                'event_details' => 'A fair focused on health awareness and wellness tips.',
                'location'      => 'Miami',
                'venue'         => 'Convention Center',
                'date'          => '2024-12-10',
                'time'          => '09:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'Bring your own water bottle.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'event_name'    => 'Food Festival',
                'event_type'    => 'Festival',
                'event_details' => 'A celebration of culinary delights from around the world.',
                'location'      => 'Seattle',
                'venue'         => 'Seattle Center',
                'date'          => '2025-02-14',
                'time'          => '11:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'No outside food allowed.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'event_name'    => 'Coding Bootcamp',
                'event_type'    => 'Workshop',
                'event_details' => 'An intensive coding bootcamp for beginners.',
                'location'      => 'Austin',
                'venue'         => 'Tech Hub',
                'date'          => '2025-03-05',
                'time'          => '09:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'Registration required.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'event_name'    => 'Book Launch',
                'event_type'    => 'Launch',
                'event_details' => 'Launch of a new novel by a local author.',
                'location'      => 'Boston',
                'venue'         => 'Public Library',
                'date'          => '2025-04-12',
                'time'          => '15:00:00',
                'poster'        => 'resources/images/poster/LmepsYtkXxMmmVNiiqhyJBn0P7ldSu6QZl017oaB.jpg',
                'terms'         => 'Free copies for the first 50 attendees.',
                'event_status'  => 'active',
                'user_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}
