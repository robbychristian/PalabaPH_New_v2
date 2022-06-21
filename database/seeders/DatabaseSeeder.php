<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Laundries;
use App\Models\LaundryAddress;
use App\Models\MobileUsers;
use Faker\Factory;

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
        //Admin
        User::create([
            'id' => 0,
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => '',
            'birth_day' => '',
            'email' => 'admin@palabaph.com',
            'password' => Hash::make('palabaph'),
            'user_role' => '1',
        ]);

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
