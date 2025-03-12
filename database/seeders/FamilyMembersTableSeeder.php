<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FamilyMembersTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('family_members')->delete();
        
        \DB::table('family_members')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type_id' => 2,
                'member_id' => 1,
                'family_id' => 1,
                'created_at' => '2025-03-12 11:06:02',
                'updated_at' => '2025-03-12 11:06:02',
            ),
            1 => 
            array (
                'id' => 2,
                'type_id' => 3,
                'member_id' => 2,
                'family_id' => 1,
                'created_at' => '2025-03-12 11:06:02',
                'updated_at' => '2025-03-12 11:06:02',
            ),
        ));

        
    }
}