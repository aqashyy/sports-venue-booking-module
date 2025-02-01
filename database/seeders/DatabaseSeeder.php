<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
            $start_time =   Carbon::parse('06:00');
            $close_time = $start_time->copy()->addHours(rand(8,12));
            Venue::create([
                'name' => fake()->randomElement($venue_names),
                'open_time' =>  $start_time->format('H:i'),
                'close_time' =>  $close_time->format('H:i'),
            ]);
        }
    }
}
