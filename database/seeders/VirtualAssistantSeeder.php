<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VirtualAssistant;
use App\Models\User;
use App\Models\Lead;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class VirtualAssistantSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Retrieve a random Lead or create one if none exist
        $lead = 9;

        // Create 10 Virtual Assistants
        for ($i = 0; $i < 15; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $email = $faker->unique()->safeEmail;

            // Create Virtual Assistant
            $virtualAssistant = VirtualAssistant::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone_no' => $faker->unique()->phoneNumber,
                'email' => $email,
                'position' => $faker->jobTitle,
                'company_id' => $lead,
            ]);

            // Also store in users table
            User::create([
                'name' => $firstName . ' ' . $lastName,
                'email' => $email,
                'password' => Hash::make('12345678'),
                'role' => 'Virtual Assistant',
                'company' => $lead,
            ]);
        }
    }
}
