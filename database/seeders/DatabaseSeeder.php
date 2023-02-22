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

        // seed 6 listings with owner $company
        Listing::factory(6)->create([
            'company_id' => $company->id,
            'company' => $company->name,
            'email' => $company->email,
            'website' => $company->website,
            'location' => $company->location
        ]);

        //        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
