<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Venue;
use Illuminate\Database\Seeder;
// use Faker\Factory as Faker;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // $faker = Faker::create();

        // Venue::factory()->count(5)->create();

        // User::factory(5)->create([
        //     'phone' =>  $faker->phoneNumber,
        // ]);

        // User::create([
        //     'name'  =>  'ashiq',
        //     'email' =>  'ashiq@gmail.com',
        //     'phone' =>  '917994363996',
        //     'password'  =>  bcrypt('ashiq@123')
        // ]);
        $venue_names =  ['Football', 'Badminton', 'Tennis', 'Basketball', 'Cricket'];
        for ($i = 0; $i < 5; $i++) {
            Venue::create([
                'name' => fake()->randomElement($venue_names),
                'open_time' =>  fake()->time('H:i:s', '06:00:00'),
                'close_time' =>  fake()->time('H:i:s', '22:00:00'),
            ]);
        }
    }
}
