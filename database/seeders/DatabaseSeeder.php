<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Laundries;
use App\Models\LaundryAddress;
use App\Models\MobileUsers;
use App\Models\CustomerAddress;
use Faker\Factory;
use App\Models\Complaints;
use Carbon\Carbon;

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
        // Admin
        User::create([
            'id' => 0,
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => '',
            'birth_day' => '',
            'email' => 'admin@palabaph.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('palabaph'),
            'user_role' => '1',
            'is_blocked' => 0
        ]);

        // $mobile = MobileUsers::create([
        //     'first_name' => "Robby Christian",
        //     'middle_name' => "Derit",
        //     'last_name' => "De Leon",
        //     'contact_no' => "09123456789",
        //     'email' => "mobile@gmail.com",
        //     'password' => Hash::make('password'),
        //     'is_blocked' => 0,
        //     'user_role' => 3,
        // ]);

        // $address = CustomerAddress::create([
        //     'customer_id' => $mobile->id,
        //     'street' => '12A',
        //     'state' => '1374Ncr, Second District',
        //     'barangay' => '137404063Masagana',
        //     'city' => '137404Quezon City',
        //     'region' => '13National Capital Region (NCR)',
        // ]);

        // Complaints::create([
        //     'laundry_id' => 1,
        //     'user_id' => 24,
        //     'comment' => 'Missing underwear',
        //     'reply' => 'none',
        //     'complaint_image' => "no_image.jpg"
        // ]);

        //CUSTOMER POPULATE
        // $faker = Factory::create();
        // foreach (range(1, 20) as $index) {
        //     MobileUsers::create([
        //         'first_name' => $faker->firstName(),
        //         'middle_name' => $faker->lastName(),
        //         'last_name' => $faker->lastName(),
        //         'contact_no' => $faker->phoneNumber(),
        //         'email' => $faker->safeEmail(),
        //         'pass' => Hash::make('password'),
        //         'is_blocked' => 0,
        //         'user_role' => '3',
        //     ]);
        // }
    }
}
