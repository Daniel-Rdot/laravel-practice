<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Termwind\Components\Li;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create single user who will own all the listings
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ]);

        // seed 6 listings with owner $user
        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

        //        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
