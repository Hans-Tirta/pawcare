<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rescuer;
use App\Models\RescueCase;
use App\Models\Animal;
use App\Models\ProgressUpdate;
use App\Models\Donation;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::factory()->admin()->create([
            'name' => 'Admin PawCare',
            'email' => 'admin@pawcare.com',
            'password' => bcrypt('password'),
        ]);

        // Create Rescuer Users with Rescuer Profiles
        $rescuerUsers = User::factory()->rescuer()->count(5)->create();
        
        foreach ($rescuerUsers as $rescuerUser) {
            $rescuer = Rescuer::factory()->verified()->create([
                'user_id' => $rescuerUser->id,
            ]);

            // Each rescuer has 2-4 rescue cases
            $rescueCases = RescueCase::factory()->count(rand(2, 4))->create([
                'rescuer_id' => $rescuer->id,
            ]);

            foreach ($rescueCases as $rescueCase) {
                // Each rescue case has 1-3 animals
                Animal::factory()->count(rand(1, 3))->create([
                    'rescue_case_id' => $rescueCase->id,
                ]);

                // Each rescue case has 2-5 progress updates
                ProgressUpdate::factory()->count(rand(2, 5))->create([
                    'rescue_case_id' => $rescueCase->id,
                ]);
            }
        }

        // Create unverified rescuer for testing
        $unverifiedRescuerUser = User::factory()->rescuer()->create([
            'name' => 'Rescuer Belum Verified',
            'email' => 'rescuer@pawcare.com',
            'password' => bcrypt('password'),
        ]);
        
        Rescuer::factory()->unverified()->create([
            'user_id' => $unverifiedRescuerUser->id,
        ]);

        // Create Donor Users
        $donors = User::factory()->donor()->count(20)->create();

        // Create one specific donor for testing
        $testDonor = User::factory()->donor()->create([
            'name' => 'Donor Test',
            'email' => 'donor@pawcare.com',
            'password' => bcrypt('password'),
        ]);

        // Add donors to the donors array
        $donors->push($testDonor);

        // Create donations for rescue cases
        $allRescueCases = RescueCase::all();
        
        foreach ($allRescueCases as $rescueCase) {
            // Each rescue case gets 3-8 donations
            $donationCount = rand(3, 8);
            
            for ($i = 0; $i < $donationCount; $i++) {
                $donor = $donors->random();
                
                $donation = Donation::factory()->successful()->create([
                    'rescue_case_id' => $rescueCase->id,
                    'donor_id' => $donor->id,
                ]);

                // Update current_amount in rescue case
                $rescueCase->current_amount += $donation->amount;
            }

            $rescueCase->save();
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin: admin@pawcare.com / password');
        $this->command->info('Rescuer: rescuer@pawcare.com / password');
        $this->command->info('Donor: donor@pawcare.com / password');
    }
}
