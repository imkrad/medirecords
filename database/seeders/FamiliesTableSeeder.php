<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('families')->delete();
        
        \DB::table('families')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '2025-00001',
                'name' => 'Jumli',
                'created_at' => '2025-03-12 11:06:02',
                'updated_at' => '2025-03-12 11:06:02',
            ),
        ));

        
    }
}