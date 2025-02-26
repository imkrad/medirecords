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
            array (
                'id' => 1,
                'dose' => 1,
                'old' => 0,
                'type' => 'days',
                'is_active' => 1,
                'vaccine_id' => 1,
                'created_at' => '2025-02-25 13:46:36',
                'updated_at' => '2025-02-25 13:46:36',
            ),
            array (
                'id' => 2,
                'dose' => 1,
                'old' => 0,
                'type' => 'days',
                'is_active' => 1,
                'vaccine_id' => 2,
                'created_at' => '2025-02-25 13:47:10',
                'updated_at' => '2025-02-25 13:47:10',
            ),
            array (
                'id' => 3,
                'dose' => 1,
                'old' => 6,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 3,
                'created_at' => '2025-02-25 13:47:10',
                'updated_at' => '2025-02-25 13:47:10',
            ),
            array (
                'id' => 4,
                'dose' => 1,
                'old' => 6,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 4,
                'created_at' => '2025-02-25 13:48:26',
                'updated_at' => '2025-02-25 13:48:26',
            ),
            array (
                'id' => 5,
                'dose' => 1,
                'old' => 6,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 5,
                'created_at' => '2025-02-25 13:48:26',
                'updated_at' => '2025-02-25 13:48:26',
            ),
            array (
                'id' => 6,
                'dose' => 1,
                'old' => 6,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 8,
                'created_at' => '2025-02-25 13:50:12',
                'updated_at' => '2025-02-25 13:50:12',
            ),
            array (
                'id' => 7,
                'dose' => 2,
                'old' => 6,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 2,
                'created_at' => '2025-02-25 13:50:12',
                'updated_at' => '2025-02-25 13:50:12',
            ),
            array (
                'id' => 8,
                'dose' => 2,
                'old' => 10,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 3,
                'created_at' => '2025-02-25 13:50:38',
                'updated_at' => '2025-02-25 13:50:38',
            ),
            array (
                'id' => 9,
                'dose' => 2,
                'old' => 10,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 4,
                'created_at' => '2025-02-25 13:50:38',
                'updated_at' => '2025-02-25 13:50:38',
            ),
            array (
                'id' => 10,
                'dose' => 2,
                'old' => 10,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 5,
                'created_at' => '2025-02-25 13:51:30',
                'updated_at' => '2025-02-25 13:51:30',
            ),
            array (
                'id' => 11,
                'dose' => 2,
                'old' => 10,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 8,
                'created_at' => '2025-02-25 13:51:30',
                'updated_at' => '2025-02-25 13:51:30',
            ),
            array (
                'id' => 12,
                'dose' => 3,
                'old' => 14,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 3,
                'created_at' => '2025-02-25 14:03:38',
                'updated_at' => '2025-02-25 14:03:38',
            ),
            array (
                'id' => 13,
                'dose' => 3,
                'old' => 14,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 4,
                'created_at' => '2025-02-25 14:03:38',
                'updated_at' => '2025-02-25 14:03:38',
            ),
            array (
                'id' => 14,
                'dose' => 3,
                'old' => 14,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 5,
                'created_at' => '2025-02-25 14:04:11',
                'updated_at' => '2025-02-25 14:04:11',
            ),
            array (
                'id' => 15,
                'dose' => 3,
                'old' => 14,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 6,
                'created_at' => '2025-02-25 14:04:11',
                'updated_at' => '2025-02-25 14:04:11',
            ),
            array (
                'id' => 16,
                'dose' => 3,
                'old' => 14,
                'type' => 'weeks',
                'is_active' => 1,
                'vaccine_id' => 2,
                'created_at' => '2025-02-25 14:04:11',
                'updated_at' => '2025-02-25 14:04:11',
            ),
            array (
                'id' => 17,
                'dose' => 1,
                'old' => 6,
                'type' => 'months',
                'is_active' => 1,
                'vaccine_id' => 11,
                'created_at' => '2025-02-25 14:29:24',
                'updated_at' => '2025-02-25 14:29:24',
            ),
            array (
                'id' => 18,
                'dose' => 1,
                'old' => 9,
                'type' => 'months',
                'is_active' => 1,
                'vaccine_id' => 9,
                'created_at' => '2025-02-25 14:29:42',
                'updated_at' => '2025-02-25 14:29:42',
            ),
            array (
                'id' => 19,
                'dose' => 1,
                'old' => 12,
                'type' => 'months',
                'is_active' => 1,
                'vaccine_id' => 10,
                'created_at' => '2025-02-25 14:29:42',
                'updated_at' => '2025-02-25 14:29:42',
            ),
        ));
        

        
    }
}