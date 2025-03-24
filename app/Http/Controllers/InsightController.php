<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;

class InsightController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'tcl-chart':
                return $this->insights($request);
            break;
            case 'tcl-counts':
                return [
                    'info' => $this->info($request),
                    'tcls' => $this->tcls($request),
                ];
            break;
            default:
            return '';
        }
    }

    private function tcls($request){
        $year = ($request->year) ? $request->year : date('Y') ;

        return [
            [
                'name' => 'Family Planning',
                'description' => 'Total patients served this month.',
                'total' => Patient::whereYear('created_at',$year)->count(),
                'icon' => 'mdi mdi-human-male-female fs-20',
                'color' => 'text-success'
            ],
            [
                'name' => 'Prenatal',
                'description' => 'Total appointments scheduled this month.',
                'total' => Appointment::whereYear('created_at',$year)->count(),
                'icon' => 'mdi mdi-human-pregnant fs-20',
                'color' => 'text-success'
            ],
            [
                'name' => 'Child Immunization',
                'description' => 'Total appointments scheduled this month.',
                'total' => Appointment::whereYear('created_at',$year)->count(),
                'icon' => 'mdi mdi-human-baby-changing-table fs-20',
                'color' => 'text-success'
            ]
        ];
    }

    private function info($request){
        $year = ($request->year) ? $request->year : date('Y') ;

        return [
            [
                'name' => 'Total Patients Served',
                'description' => 'Total patients served this month.',
                'total' => Patient::whereYear('created_at',$year)->count(),
                'icon' => 'ri-group-2-fill fs-20',
                'color' => 'text-warning'
            ],
            [
                'name' => 'Total Appointments Conducted',
                'description' => 'Total appointments scheduled this month.',
                'total' => Appointment::whereYear('created_at',$year)->count(),
                'icon' => 'ri-hearts-fill fs-20',
                'color' => 'text-info'
            ]
        ];
    }

    private function insights($request){
        $year = ($request->year) ? $request->year : date('Y') ;
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        $first = []; 
        for($month = 1; $month <= 12; $month++){
            $count = Appointment::where('service_id',9)->whereYear('created_at',$year)->whereMonth('created_at',$month)->count();
            $first[] = $count;
        }
        $second = [];
        for($month = 1; $month <= 12; $month++){
            $count = Appointment::where('service_id',8)->whereYear('created_at',$year)->whereMonth('created_at',$month)->count();
            $second[] = $count;
        }
        $third = [];
        for($month = 1; $month <= 12; $month++){
            $count = Appointment::where('service_id',7)->whereYear('created_at',$year)->whereMonth('created_at',$month)->count();
            $third[] = $count;
        }

        $arr = [
            [
                'name' => 'Family Planning',
                'data' => $first
            ],
            [
                'name' => 'Prenatal', 
                'data' => $second
            ],
            [
                'name' => 'Child Immunization', 
                'data' => $third
            ]
        ];
        
        return $y =[
            'categories' => $months,
            'lists' => $arr,
        ];
    }
}
