<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Laundries;
use App\Models\LaundryAddress;

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
            'first_name' => 'Admin',
            'middle_name' => '',
            'last_name' => '',
            'email' => 'admin@palabaph.com',
            'password' => Hash::make('palabaph'),
            'user_role' => '1',
        ]);

        //FIRST CLIENT

        User::create([
            'first_name' => 'Juan',
            'middle_name' => 'Dela',
            'last_name' => 'Cruz',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'user_role' => '2',
        ]);

        Laundries::create([
            'user_id' => '2',
            'address_id' => '1',
            'name' => 'Labadaba',
            'landline' => '31234567',
            'phone' => '09123456789',
            'valid_id' => 'id.jpg',
            'bir_permit' => 'bir.jpg',
            'dti_permit' => 'dti.jpg',
            'brgy_permit' => 'brgy.jpg',
            'is_approved' => false,
            'status' => 'Pending',
        ]);

        LaundryAddress::create([
            'laundry_id' => '1',
            'street' => 'St Street',
            'barangay' => 'brgy Barangay',
            'city' => 'Valenzuela City',
            'region' => 'NCR',
        ]);
    }
}
