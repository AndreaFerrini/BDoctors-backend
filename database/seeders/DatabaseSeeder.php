<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\DoctorsTableSeeder;
use Database\Seeders\ReviewsTableSeeder;
use Database\Seeders\MessagesTableSeeder;
use Database\Seeders\SponsorsTableSeeder;
use Database\Seeders\TypologiesTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            
            
            UsersTableSeeder::class,
            DoctorsTableSeeder::class,
            ReviewsTableSeeder::class,
            MessagesTableSeeder::class,
            TypologiesTableSeeder::class,
            SponsorsTableSeeder::class,
           
        ]);
    }
}
