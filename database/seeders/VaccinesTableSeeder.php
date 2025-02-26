<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VaccinesTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vaccines')->delete();
        
        \DB::table('vaccines')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bacille Calmette-Guérin',
                'description' => 'Protects against tuberculosis',
                'short' => 'BCG',
                'created_at' => '2025-02-25 13:07:51',
                'updated_at' => '2025-02-25 13:07:51',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Hepatitis B Vaccine',
                'description' => 'Prevents hepatitis B infection',
                'short' => 'Hepa B',
                'created_at' => '2025-02-25 13:07:51',
                'updated_at' => '2025-02-25 13:07:51',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pentavalent Vaccine',
            'description' => 'Protects against diphtheria, pertussis (whooping cough), tetanus, hepatitis B, and Haemophilus influenzae type b',
                'short' => 'PENTA ',
                'created_at' => '2025-02-25 13:17:53',
                'updated_at' => '2025-02-25 13:17:53',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Oral Polio Vaccine',
                'description' => 'Prevents poliovirus infection',
                'short' => 'OPV',
                'created_at' => '2025-02-25 13:17:53',
                'updated_at' => '2025-02-25 13:17:53',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Pneumococcal Conjugate Vaccine',
                'description' => 'Protects against pneumococcal diseases like pneumonia and meningitis',
                'short' => 'PCV',
                'created_at' => '2025-02-25 13:19:39',
                'updated_at' => '2025-02-25 13:19:39',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Inactivated Polio Vaccine',
                'description' => 'Provides additional protection against poliovirus',
                'short' => 'IPV',
                'created_at' => '2025-02-25 13:27:22',
                'updated_at' => '2025-02-25 13:27:22',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Hepatitis A Vaccine',
                'description' => 'A viral infection that affects the liver and spreads through contaminated food and water',
                'short' => 'Hepa A',
                'created_at' => '2025-02-25 13:27:22',
                'updated_at' => '2025-02-25 13:27:22',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Rotavirus Vaccine',
                'description' => 'A leading cause of severe diarrhea among infants and young children, and vaccination significantly reduces hospitalizations and deaths related to the disease.',
                'short' => 'ROTA',
                'created_at' => '2025-02-25 13:27:22',
                'updated_at' => '2025-02-25 13:27:22',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Anti-Measles Vaccine',
                'description' => 'Protects against measles and rubella',
                'short' => 'MCV 1 - AMV',
                'created_at' => '2025-02-25 13:27:22',
                'updated_at' => '2025-02-25 13:27:22',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Measles, Mumps, and Rubella Vaccine',
                'description' => 'Protects against measles and rubella',
                'short' => 'MCV 2 - MMR',
                'created_at' => '2025-02-25 13:27:22',
                'updated_at' => '2025-02-25 13:27:22',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Influenza',
                'description' => 'The flu virus mutates every year, so an annual flu shot is necessary for protection',
                'short' => 'Flu',
                'created_at' => '2025-02-25 14:28:44',
                'updated_at' => '2025-02-25 14:28:44',
            ),
        ));

        
    }
}