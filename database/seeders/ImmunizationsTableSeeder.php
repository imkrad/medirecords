<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImmunizationsTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('immunizations')->delete();
        
        \DB::table('immunizations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'dose' => 1,
                'old' => 0.0,
                'type' => 'days',
                'is_active' => 1,
                'vaccine_id' => 1,
                'created_at' => '2025-02-25 13:46:36',
                'updated_at' => '2025-02-25 13:46:36',
            ),
            1 => 
            array (
                'id' => 2,
                'dose' => 1,
                'old' => 0.0,
                'type' => 'days',
                'is_active' => 1,
                'vaccine_id' => 2,
                'created_at' => '2025-02-25 13:47:10',
                'updated_at' => '2025-02-25 13:47:10',
            ),
            2 => 
            array (
                'id' => 3,
                'dose' => 1,
                'old' => 1.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'dose' => 2,
                'old' => 2.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'dose' => 3,
                'old' => 3.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'dose' => 1,
                'old' => 1.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'dose' => 2,
                'old' => 2.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'dose' => 3,
                'old' => 3.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'dose' => 1,
                'old' => 1.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'dose' => 2,
                'old' => 2.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'dose' => 3,
                'old' => 3.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'dose' => 1,
                'old' => 3.5,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'dose' => 2,
                'old' => 9.0,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'dose' => 1,
                'old' => 9.0,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'dose' => 2,
                'old' => 12.0,
                'type' => 'Months',
                'is_active' => 1,
                'vaccine_id' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));

        
    }
}