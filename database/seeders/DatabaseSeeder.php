<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Termwind\Components\Li;
use App\Models\Company;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create single user who will own all the listings
        $company = Company::factory()->create([
            'name' => 'Weyland Industries',
            'email' => 'recruiting@weyland.com',
            'password' => 'abcabc'
        ]);

        Company::factory(5)->create();

        // seed 6 listings with owner $company
        Listing::factory(3)->create([
            'company_id' => $company->id,
            'company' => $company->name,
            'email' => $company->email,
            'website' => $company->website,
            'location' => $company->location
        ]);

        User::create([
            'name' => 'daniel',
            'email' => 'daniel@test.com',
            'location' => 'Berlin',
            'password' => 'abcabc'
        ]);

        User::factory(5)->create();

        $seedno = 3;
        for ($i = 0; $i < $seedno; $i++) {
            Listing::factory()->create([
                'company_id' => rand(2, 6)
            ]);
        }


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
