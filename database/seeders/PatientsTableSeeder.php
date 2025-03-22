<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('patients')->delete();
        
        \DB::table('patients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'PTL-2025-00001',
                'email' => 'maedoe@gmail.com',
                'homephone' => '9918766',
                'cellphone' => '09171531652',
                'address' => 'Guiwa Aurora Village',
                'fullname' => 'John Doe',
                'contact_no' => '99182732',
                'relationship' => 'Father',
                'member_id' => 1,
                'created_at' => '2025-03-12 11:06:02',
                'updated_at' => '2025-03-12 11:06:02',
            ),
        ));

        
    }
}