<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('members')->delete();
        
        \DB::table('members')->insert(array (
            0 => 
            array (
                'id' => 1,
                'firstname' => 'Xantipphy',
                'lastname' => 'Jumli',
                'middlename' => 'Ibrahim',
                'sex' => 'Female',
                'status' => 'Married',
                'avatar' => 'avatar.jpg',
                'birthdate' => '1994-06-28',
                'created_at' => '2025-03-12 11:06:02',
                'updated_at' => '2025-03-12 11:06:02',
            ),
            1 => 
            array (
                'id' => 2,
                'firstname' => 'Ra-ouf',
                'lastname' => 'Jumli',
                'middlename' => 'Indanan',
                'sex' => 'Male',
                'status' => 'Married',
                'avatar' => 'avatar.jpg',
                'birthdate' => NULL,
                'created_at' => '2025-03-12 11:06:02',
                'updated_at' => '2025-03-12 11:06:02',
            ),
        ));

        
    }
}