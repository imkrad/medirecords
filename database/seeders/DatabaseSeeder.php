<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            'email' => 'admin@medirecords.com',
            'password' => bcrypt('123456789'),
            'role' => 'Administrator',
            'is_active' => 1,
            'email_verified_at' => '2024-05-15 08:46:33',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \DB::table('user_profiles')->insert([
            'firstname' => 'Chilleinne',
            'lastname' => 'Tingkahan',
            'middlename' => 'A',
            'avatar' => 'avatar.jpg',
            'gender' => 'Male',
            'user_id' => 1,
            'mobile' => '09123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
        $this->call(LocationRegionsTableSeeder::class);
        $this->call(LocationProvincesTableSeeder::class);
        $this->call(LocationMunicipalitiesTableSeeder::class);
        $this->call(LocationBarangaysTableSeeder::class);

        $this->call(ListStatusesTableSeeder::class);
        $this->call(ListDropdownsTableSeeder::class);
        $this->call(VaccinesTableSeeder::class);
        $this->call(VaccinesTableSeeder::class);
        $this->call(ImmunizationsTableSeeder::class);
    }
}
