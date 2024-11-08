<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admins;
use App\Models\Place;
use App\Models\Reservations;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            "name" => 'Widia RM',
            "email" => "widia@rm.com",
            "username" => "widia",
            "password" => bcrypt("123")
        ]);

        Admins::factory()->create([
            "name" => "Hana TN",
            "username" => "hana",
            "password" => bcrypt("123")
        ]);

        // Place::factory()->create([
        //     "admin_id" => Admins::where('id', 1)->first(),
        //     "header_image" => "sample-image.jpg",
        //     "name" => "Lokawisata Baturaden",
        //     "description" => "Tempat nyaman yang sejuk dan asri",
        //     "price" => 25000,
        //     "slug" => "baturaden",
        //     "embedded_maps" => "youtube.com"
        // ]);

        // Reservations::factory()->create([
        //     "user_id" => User::where('id', 1)->first(),
        //     "place_id" => Place::where('id', 1)->first(),
        //     "booking_for" => "10-10-2024",
        //     "total" => 25000,
        //     "status" => 1
        // ]);

        Admins::factory(1)->create();
        User::factory(1)->create();
        // Place::factory(1)->create();
    }
}
