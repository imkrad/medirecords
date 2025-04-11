<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\AppointmentFamily;
use App\Models\AppointmentFamilyVisit;
use App\Models\AppointmentFamilyCheckup;
use App\Models\AppointmentMaternalCheckup;
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
                'family.visits'
            ])
            ->where('service_id', $id)
            ->get()
            ->map(function ($item) {
                $aid = $item->id;
        
                $appointmentVisits = AppointmentFamilyVisit::whereHas('af.appointment', function ($query) use ($aid) {
                    $query->where('id', $aid);
                })->get()->groupBy(fn ($visit) => (int) Carbon::parse($visit->visited_at)->format('m'));
        
                $visits = array_map(fn ($month) => isset($appointmentVisits[$month]), range(1, 12));
        
                $checkups = AppointmentFamilyCheckup::with('type')
                    ->whereHas('af.appointment', function ($query) use ($aid) {
                        $query->where('id', $aid);
                    })
                    ->whereIn('count', ['1st dose given', '2nd dose given', '3rd dose given'])
                    ->get()
                    ->keyBy('count');
        
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
        }else if($id == 8){
            $data = Appointment::with('patient.member','service','status')
            ->with('maternal.checkups.type','maternal.checkups.subtype')
            ->with('maternal.deliveries.outcome','maternal.deliveries.facility','maternal.deliveries.attendant','maternal.deliveries.weight','maternal.deliveries.delivery','maternal.deliveries.member')
            ->where('service_id', $id)
            ->get()
            ->map(function ($item) {
                $aid = $item->id;
                $checkups = [
                    '1' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                            $query->where('name', 'Prenatal Check-ups');
                        })->where('count','1st Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '2' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Prenatal Check-ups');
                    })->where('count','2nd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '3' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Prenatal Check-ups');
                    })->where('count','3rd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '4' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td1/TT1')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '5' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td2/TT2')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '6' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td3/TT3')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '7' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td4/TT4')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '8' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td5/TT5')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '9' => false,
                    '10' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','1st Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '11' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','2nd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '12' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','3rd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '13' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','4th Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '14' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Calcium Carbonate');
                    })
                    ->where('count','2nd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '15' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Calcium Carbonate');
                    })
                    ->where('count','3rd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '16' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Calcium Carbonate');
                    })
                    ->where('count','4th Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '17' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iodine Capsules');
                    })
                    ->where('count','1st Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '18' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Nutritional Assessment');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '19' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Deworming Tablet');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '20' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Infectious Disease Surveillance');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Screening');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '21' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Infectious Disease Surveillance');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Hepatitis B (Result of HbsAg)');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '22' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Infectious Disease Surveillance');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'HIV (Date of Screening)');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '23' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Laboratory Screening');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Gestational Diabetes');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '24' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Laboratory Screening');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'CBC/Hgb & Hct Count');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                ];
                return [
                    'name'         => $item->patient->member->lastname . ', ' . $item->patient->member->firstname . ' ' . $item->patient->member->middlename[0].'.',
                    'registration' => $item->registration_at,
                    'age'          => $item->age,
                    'checkups' => $checkups
                ];
            });

            return inertia('Dashboard/Maternal',[
                'lists' => $data
            ]);
        }else if($id == 7){
            return inertia('Dashboard/Immunization',[
                'lists' => []
            ]);
        }
    }

    public function print($code){
        if($code == 9){
            $data = Appointment::with([
                'patient.member.families.family',
                'service',
                'status',
                'family.reason',
                'family.type',
                'family.method',
                'family.visits'
            ])
            ->where('service_id', $code)
            ->get()
            ->map(function ($item) {
                $aid = $item->id;
        
                $appointmentVisits = AppointmentFamilyVisit::whereHas('af.appointment', function ($query) use ($aid) {
                    $query->where('id', $aid);
                })->get()->groupBy(fn ($visit) => (int) Carbon::parse($visit->visited_at)->format('m'));
                
                // store actual date string (first one for that month) or null
                $visits = array_map(function ($month) use ($appointmentVisits) {
                    return isset($appointmentVisits[$month]) ? $appointmentVisits[$month]->first()->visited_at : null;
                }, range(1, 12));
        
                $checkups = AppointmentFamilyCheckup::with('type')
                ->whereHas('af.appointment', function ($query) use ($aid) {
                    $query->where('id', $aid);
                })
                ->whereIn('count', ['1st dose given', '2nd dose given', '3rd dose given'])
                ->get()
                ->keyBy('count')
                ->map(fn ($item) => $item->date_at);
        
                $dropout = AppointmentFamily::with('reason')
                    ->where('is_dropout', 1)
                    ->whereHas('appointment', function ($query) use ($aid) {
                        $query->where('id', $aid);
                    })
                    ->value('dropout_at');
        
                return [
                    'name'         => $item->patient->member->lastname . ', ' . $item->patient->member->firstname . ' ' . $item->patient->member->middlename,
                    'registration' => $item->registration_at,
                    'serial_no'    => $item->patient->member->families[0]->family->code,
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

            $array = [
                'lists' => $data,
            ];
            $doubleLandscape = [0, 0, 1800, 595.28];
            $pdf = \PDF::loadView('reports.family',$array)->setPaper($doubleLandscape, 'portrait'); 
            $pdf->output();
            $dompdf = $pdf->getDomPDF();
            $canvas = $dompdf->getCanvas();
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                $copies = 1;
                $totalPagesPerCopy = $pageCount / $copies;
                $currentPageInCopy = ($pageNumber - 1) % $totalPagesPerCopy + 1;
                $text = "PAGE $currentPageInCopy OF $totalPagesPerCopy";
                $font = $fontMetrics->get_font("Helvetica", "normal");
                $size = 7;
                $width = $fontMetrics->get_text_width($text, $font, $size);
                $canvas->text(106 - $width, 796, $text, $font, $size);
            });
            return $pdf->stream('familyplanning.pdf');

       }else if($code == 8){

        $data = Appointment::with('patient.member.families.family','service','status')
            ->with('maternal.checkups.type','maternal.checkups.subtype')
            ->with('maternal.deliveries.outcome','maternal.deliveries.facility','maternal.deliveries.attendant','maternal.deliveries.weight','maternal.deliveries.delivery','maternal.deliveries.member')
            ->where('service_id', $code)
            ->get()
            ->map(function ($item) {
                $aid = $item->id;
                $checkups = [
                    '1' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                            $query->where('name', 'Prenatal Check-ups');
                        })->where('count','1st Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '2' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Prenatal Check-ups');
                    })->where('count','2nd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '3' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Prenatal Check-ups');
                    })->where('count','3rd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '4' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td1/TT1')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '5' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td2/TT2')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '6' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td3/TT3')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '7' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td4/TT4')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '8' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Immunization Status');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                    })
                    ->where('count','Td5/TT5')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '9' => false,
                    '10' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','1st Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '11' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','2nd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '12' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','3rd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '13' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iron Sulfate with Folic Acid');
                    })
                    ->where('count','4th Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '14' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Calcium Carbonate');
                    })
                    ->where('count','2nd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '15' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Calcium Carbonate');
                    })
                    ->where('count','3rd Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '16' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Calcium Carbonate');
                    })
                    ->where('count','4th Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '17' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Micronutrient Supplementation');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Iodine Capsules');
                    })
                    ->where('count','1st Trimester')->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '18' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Nutritional Assessment');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '19' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Deworming Tablet');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '20' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Infectious Disease Surveillance');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Screening');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '21' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Infectious Disease Surveillance');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Hepatitis B (Result of HbsAg)');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '22' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Infectious Disease Surveillance');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'HIV (Date of Screening)');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '23' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Laboratory Screening');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'Gestational Diabetes');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                    '24' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Laboratory Screening');
                    })
                    ->whereHas('subtype', function ($query) {
                        $query->where('name', 'CBC/Hgb & Hct Count');
                    })
                    ->whereHas('am.appointment', function ($query) use ($aid) { $query->where('id', $aid); })->get(),
                ];
                return [
                    'name'         => $item->patient->member->lastname . ', ' . $item->patient->member->firstname . ' ' . $item->patient->member->middlename[0].'.',
                    'registration' => $item->registration_at,
                    'serial_no'    => $item->patient->member->families[0]->family->code,
                    'age'          => $item->age,
                    'checkups' => $checkups
                ];
            });
            
            $array = [
                'lists' => $data,
            ];

            // dd($array);
            $doubleLandscape = [0, 0, 2000, 595.28];
            $pdf = \PDF::loadView('reports.prenatal',$array)->setPaper($doubleLandscape, 'portrait'); 
            $pdf->output();
            $dompdf = $pdf->getDomPDF();
            $canvas = $dompdf->getCanvas();
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                $copies = 1;
                $totalPagesPerCopy = $pageCount / $copies;
                $currentPageInCopy = ($pageNumber - 1) % $totalPagesPerCopy + 1;
                $text = "PAGE $currentPageInCopy OF $totalPagesPerCopy";
                $font = $fontMetrics->get_font("Helvetica", "normal");
                $size = 7;
                $width = $fontMetrics->get_text_width($text, $font, $size);
                $canvas->text(106 - $width, 796, $text, $font, $size);
            });
            return $pdf->stream('prenatal.pdf');
       }else{

       }
    }

}
