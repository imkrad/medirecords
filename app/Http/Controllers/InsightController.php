<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\AppointmentFamilyVisit;
use App\Models\AppointmentMaternalCheckup;

class InsightController extends Controller
{
    public function __construct()
    {
        $this->start = now()->copy()->startOfMonth()->format('Y-m-d');
        $this->end = now()->copy()->endOfMonth()->format('Y-m-d');
    }

    public function index(Request $request){
        switch($request->option){
            case 'tcl-chart':
                return $this->insights($request);
            break;
            case 'tcl-top':
                return $this->top($request);
            break;
            case 'tcl-counts':
                return [
                    'info' => $this->info($request),
                    'tcls' => $this->tcls($request),
                ];
            break;
            case 'tcl-schedule':
                return [
                    'visits' => $this->visits_sched($request),
                    'immunizations' => $this->immunizations_sched($request),
                    'checkups' => $this->checkups_sched($request),
                ];
            break;
            default:
            return '';
        }
    }

    private function visits_sched($request){
        $data = AppointmentFamilyVisit::with('af.appointment.patient.member')->whereNull('visited_at')->get();
        return $data;
    }

    private function checkups_sched($request){
        $data = AppointmentFamilyVisit::with('af.appointment.patient.member')->whereNull('visited_at')->get();
        return $data;
    }

    private function immunizations_sched($request){
        $data = AppointmentFamilyVisit::with('af.appointment.patient.member')->whereNull('visited_at')->get();
        return $data;
    }

    private function top($request){
        return [
            $this->checkups($request),
            $this->immunizations($request),
            $this->visits($request),
        ];
    }

    private function checkups($request){
        $series = [];
        $data = AppointmentMaternalCheckup::select(\DB::raw('DATE(created_at) AS x'), \DB::raw('count(*) AS y'))
        ->whereBetween('created_at', [$this->start, $this->end])
        ->groupBy(\DB::raw('DATE(created_at)'))
        ->orderBy(\DB::raw('DATE(created_at)'))
        ->get()->map(function ($item) {
            return [
                'x' => date('F d, Y',strtotime($item->x)),
                'y' => $item->y
            ];
        });
        $info = [
            'name' => 'Prenatal Checkups',
            'data' => $data
        ];
        array_push($series,$info);
        return $arr = [
            'name' => 'Prenatal Checkups',
            'icon' => 'mdi mdi-human-pregnant',
            'type' => 'Check Scheduled Checkups',
            't' => 'checkup',
            'color' => '',
            'series' => $series,
            'total' => AppointmentMaternalCheckup::whereBetween('created_at',[$this->start,$this->end])->count()
        ];
    }

    private function immunizations($request){
        $series = [];
        $data = AppointmentFamilyVisit::select(\DB::raw('DATE(scheduled_at) AS x'), \DB::raw('count(*) AS y'))
        ->whereBetween('scheduled_at', [$this->start, $this->end])
        ->where('visited_at',null)
        ->groupBy(\DB::raw('DATE(scheduled_at)'))
        ->orderBy(\DB::raw('DATE(scheduled_at)'))
        ->get()->map(function ($item) {
            return [
                'x' => date('F d, Y',strtotime($item->x)),
                'y' => $item->y
            ];
        });
        $info = [
            'name' => 'Child Immunization',
            'data' => $data
        ];
        array_push($series,$info);
        return $arr = [
            'name' => 'Child Immunization',
            'icon' => 'mdi mdi-human-baby-changing-table',
            'type' => 'Upcoming Immunization Dates',
            't' => 'immunization',
            'color' => '',
            'series' => $series,
            'total' => AppointmentFamilyVisit::whereBetween('scheduled_at',[$this->start,$this->end])->count()
        ];
    }

    private function visits($request){
        $series = [];
        $data = AppointmentFamilyVisit::select(
                \DB::raw('DATE_FORMAT(scheduled_at, "%Y-%m") AS x'), 
                \DB::raw('COUNT(*) AS y')
            )
            ->whereBetween('scheduled_at', [\Carbon\Carbon::parse($this->start)->startOfYear(), \Carbon\Carbon::parse($this->end)->endOfYear()])
            ->whereNull('visited_at')
            ->groupBy(\DB::raw('DATE_FORMAT(scheduled_at, "%Y-%m")'))
            ->orderBy(\DB::raw('DATE_FORMAT(scheduled_at, "%Y-%m")'))
            ->get()
            ->map(function ($item) {
                return [
                    'x' => date('F Y', strtotime($item->x . '-01')), // Format as "January 2024"
                    'y' => $item->y
                ];
            });
        
        $info = [
            'name' => 'Family Visits',
            'data' => $data
        ];
        
        array_push($series, $info);
        
        return [
            'name' => 'Family Visits',
            'icon' => 'mdi mdi-human-male-female',
            'type' => 'Family Visit Appointments',
            't' => 'visit',
            'color' => '',
            'series' => $series,
            'total' => AppointmentFamilyVisit::whereBetween('scheduled_at', [
                \Carbon\Carbon::parse($this->start)->startOfYear(), 
                \Carbon\Carbon::parse($this->end)->endOfYear()
            ])->count()
        ];
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
