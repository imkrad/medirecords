<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListDropdownsTableSeeder extends Seeder
{
    /**
     * Auto generated seeder file.
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_dropdowns')->delete();
        
        \DB::table('list_dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'classification' => 'n/a',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Mother',
                'classification' => 'Family',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Father',
                'classification' => 'Family',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Children',
                'classification' => 'Family',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Adult Consultation',
                'classification' => 'Service',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Child Consultation',
                'classification' => 'Service',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Child Immunization',
                'classification' => 'Service',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Prenatal',
                'classification' => 'Service',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Family Planning',
                'classification' => 'Service',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Caesarian Section',
                'classification' => 'Delivery',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Vaginal Delivery',
                'classification' => 'Delivery',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'New Acceptors',
                'classification' => 'Type',
                'type' => 'Family Planning',
                'color' => 'n/a',
                'others' => 'NA',
                'is_active' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Current User',
                'classification' => 'Type',
                'type' => 'Family Planning',
                'color' => 'n/a',
                'others' => 'CU',
                'is_active' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Changing Method',
                'classification' => 'Type',
                'type' => 'Family Planning',
                'color' => 'n/a',
                'others' => 'CM',
                'is_active' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Changing Clinic',
                'classification' => 'Type',
                'type' => 'Family Planning',
                'color' => 'n/a',
                'others' => 'CC',
                'is_active' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Restarter',
                'classification' => 'Type',
                'type' => 'Family Planning',
                'color' => 'n/a',
                'others' => 'RS',
                'is_active' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Pregnant',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'A',
                'is_active' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Desire to become pregnant',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'B',
                'is_active' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Medical Complications',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'C',
                'is_active' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Fear of side effects',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'D',
                'is_active' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Changed Clinic',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'E',
                'is_active' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Husband disapproves',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'F',
                'is_active' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Menopause',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'G',
                'is_active' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Lost or moved out of the area',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'H',
                'is_active' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Failed to get supply',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'I',
                'is_active' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Change Method',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'J',
                'is_active' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Underwent Hysterectomy',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'K',
                'is_active' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Underwent Bilateral Salpingo-oophorectomy',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'L',
                'is_active' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'No FP Commodity',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'M',
                'is_active' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Unknown',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'N',
                'is_active' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Age out for BTL',
                'classification' => 'Reason',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'O',
                'is_active' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'None or New Acceptor',
                'classification' => 'Method',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'FSTR/BTL',
                'is_active' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Pending',
                'classification' => 'Status',
                'type' => 'n/a',
                'color' => 'bg-warning',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Ongoing',
                'classification' => 'Status',
                'type' => 'n/a',
                'color' => 'bg-info',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Completed',
                'classification' => 'Status',
                'type' => 'n/a',
                'color' => 'bg-success',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Cancelled',
                'classification' => 'Status',
                'type' => 'n/a',
                'color' => 'bg-danger',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Dropped',
                'classification' => 'Status',
                'type' => 'n/a',
                'color' => 'bg-dark',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Immunization Status',
                'classification' => 'Maternal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Micronutrient Supplementation',
                'classification' => 'Maternal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Nutritional Assessment',
                'classification' => 'Maternal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Deworming Tablet',
                'classification' => 'Maternal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Infectious Disease Surveillance',
                'classification' => 'Maternal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Laboratory Screening',
                'classification' => 'Maternal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Full Term',
                'classification' => 'Outcome',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'FT',
                'is_active' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Pre-Term',
                'classification' => 'Outcome',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'PT',
                'is_active' => 1,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Fetal Death',
                'classification' => 'Outcome',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'FD',
                'is_active' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Abortion/Miscarriage',
                'classification' => 'Outcome',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'AB',
                'is_active' => 1,
            ),
        ));

        
    }
}