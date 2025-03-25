<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\AppointmentFamily;
use App\Models\AppointmentFamilyVisit;
use App\Models\AppointmentFamilyCheckup;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        if(!\Auth::check()){
            return inertia('Auth/Login');
        }else{
            return inertia('Dashboard/Index');
        }
    }

    public function tcls($id){
        if($id == 9){

            $data = Appointment::with([
                'patient.member',
                'service',
                'status',
                'family.reason',
                'family.type',
                'family.method',
                'family.visits',
                'maternal.checkups.type',
                'maternal.checkups.subtype',
                'maternal.deliveries.outcome',
                'maternal.deliveries.facility',
                'maternal.deliveries.attendant',
                'maternal.deliveries.weight',
                'maternal.deliveries.delivery',
                'maternal.deliveries.member'
            ])
            ->where('service_id', $id)
            ->get()
            ->map(function ($item) {
                $aid = $item->id;
        
                // Retrieve all visits in a single query
                $appointmentVisits = AppointmentFamilyVisit::whereHas('af.appointment', function ($query) use ($aid) {
                    $query->where('id', $aid);
                })->get()->groupBy(fn ($visit) => (int) Carbon::parse($visit->visited_at)->format('m'));
        
                // Check existence for each month (January to December)
                $visits = array_map(fn ($month) => isset($appointmentVisits[$month]), range(1, 12));
        
                // Fetch checkups more efficiently
                $checkups = AppointmentFamilyCheckup::with('type')
                    ->whereHas('af.appointment', function ($query) use ($aid) {
                        $query->where('id', $aid);
                    })
                    ->whereIn('count', ['1st dose given', '2nd dose given', '3rd dose given'])
                    ->get()
                    ->keyBy('count');
        
                // Check if the appointment is a dropout
                $dropout = AppointmentFamily::with('reason')
                    ->where('is_dropout', 1)
                    ->whereHas('appointment', function ($query) use ($aid) {
                        $query->where('id', $aid);
                    })
                    ->first();
        
                return [
                    'name'         => $item->patient->member->lastname . ', ' . $item->patient->member->firstname . ' ' . $item->patient->member->middlename,
                    'registration' => $item->registration_at,
                    'age'          => $item->age,
                    'type'         => $item->family->type->name,
                    'method'       => $item->family->method->name,
                    'visits'       => array_merge($visits, [
                        $checkups['1st dose given'] ?? null,
                        $checkups['2nd dose given'] ?? null,
                        $checkups['3rd dose given'] ?? null,
                        $dropout
                    ])
                ];
            });
        
         
            return inertia('Dashboard/Family',[
                'lists' => $data
            ]);
        }
    }

}
