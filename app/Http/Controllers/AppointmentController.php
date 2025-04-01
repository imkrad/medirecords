<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Member;
use App\Models\FamilyMember;
use App\Models\Appointment;
use App\Models\AppointmentFamily;
use App\Models\AppointmentFamilyVisit;
use App\Models\AppointmentFamilyCheckup;
use App\Models\AppointmentMaternal;
use App\Models\AppointmentMaternalCheckup;
use App\Models\AppointmentMaternalDelivery;
use App\Models\ListDropdown;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Traits\HandlesTransaction;

class AppointmentController extends Controller
{
    use HandlesTransaction;

    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->lists($request);
            break;
            default: 
                return inertia('Appointments/Index',[
                    'services' => $this->dropdowns('Service'),
                    'statuses' => $this->dropdowns('Status'),
                    'families' => [
                        'types' => $this->dropdowns('Type'),
                        'methods' => $this->dropdowns('Method'),
                    ],
                    'immunizations' => [
                        'cpabs' => $this->dropdowns('Cpab'),
                        'weights' => $this->dropdowns('Weight'),
                    ]
                ]);
        }
    }

    public function store(AppointmentRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            $data = Appointment::create([
                'code' => 'APP-'.date('Y').'-'.str_pad((Appointment::count()+1), 5, '0', STR_PAD_LEFT),
                'age' => Carbon::parse($request->patient_id['birthdate'])->age,
                'is_nhts' => $request->is_nhts,
                'patient_id' => $request->patient_id['value'],
                'service_id' => $request->service_id,
                'registration_at' => $request->registration_at,
                'status_id' => 33
            ]);
            if($data){
                if($request->service_id == 9){
                    $family = $data->family()->create([
                        'method_id' => $request->method_id,
                        'type_id' => $request->type_id,
                        'source' => $request->source,
                        'additional_info' => json_encode($request->additional_info)
                    ]);
                }else if($request->service_id == 8){
                    $maternal = $data->maternal()->create([
                        'lmp_at' => $request->lmp_at,
                        'edc_at' => $request->edc_at,
                        'height' => $request->height,
                        'weight' => $request->weight,
                        'with_medication' => $request->with_medication,
                        'additional_info' => json_encode($request->additional_info2)
                    ]);
                }else if($request->service_id == 7){
                    $immunization = $data->immunization()->create([
                        'was_breastfeed' => $request->was_breastfeed,
                        'weight_id' => $request->weight_id,
                        'cpab_id' => $request->cpab_id,
                        'height' => $request->height,
                        'weight' => $request->weight,
                    ]);
                }
            }

            return [
                'data' => [],
                'message' => 'Appointment creation was successful!', 
                'info' => "You've successfully created the new patient."
            ];
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function dropout(Request $request){
        $request->validate([
            'reason_id' => 'required',
            'dropout_at' => 'required',
        ]);

        $data = AppointmentFamily::where('appointment_id',$request->id)->first();
        $data->reason_id = $request->reason_id;
        $data->dropout_at = $request->dropout_at;
        $data->is_dropout = $request->is_dropout;
        if($data->save()){
            $status = Appointment::where('id',$request->id)->first();
            $status->status_id = 37;
            $status->save();
        }

        return back()->with([
            'data' => [],
            'message' => 'Appointment dropout was successful!',
            'info' => 'Appointment dropout was successful!',
            'status' => true,
        ]);
        
    }

    public function status(Request $request){
        $request->validate([
            'remarks' => 'required'
        ]);

        $status = Appointment::where('id',$request->id)->first();
        $status->status_id = 35;
        $status->remarks = $request->remarks;
        $status->save();

        return back()->with([
            'data' => [],
            'message' => 'Status was updated!',
            'info' => 'Status mark as completed successful!',
            'status' => true,
        ]);
    }
    
    public function schedule(Request $request){
        $request->validate([
            'scheduled_at' => 'required',
        ]);

        $data = new AppointmentFamilyVisit;
        $data->scheduled_at = $request->scheduled_at;
        $data->af_id = $request->af_id;
        $data->save();

        return back()->with([
            'data' => [],
            'message' => 'Schedule was set!',
            'info' => 'Schedule was set successful!',
            'status' => true,
        ]);
    }

    public function visit(Request $request){
        $request->validate([
            'visited_at' => 'required',
            'bloodpressure' => 'required',
            'pulserate' => 'required',
            'temperature' => 'required',
            'remarks' => 'required'
        ]);

        $data = AppointmentFamilyVisit::with('af')->where('id',$request->af_id)->first();
        $data->visited_at = $request->visited_at;
        $data->bloodpressure = $request->bloodpressure;
        $data->pulserate = $request->pulserate;
        $data->temperature = $request->temperature;
        $data->remarks = $request->remarks;
        if($data->save()){
            $status = Appointment::where('id',$data->af->appointment_id)->first();
            $status->status_id = 34;
            $status->save();
        }

        return back()->with([
            'data' => [],
            'message' => 'Visit was set!',
            'info' => 'Visit was set successful!',
            'status' => true,
        ]);
    }

    public function delivery(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'birthdate' => 'required',
            'sex' => 'required',
            'status' => 'required',
            'delivery_id' => 'required',
            'outcome_id' => 'required',
            'weight_id' => 'required',
            'facility_id' => 'required',
            'attendant_id' => 'required',
            'attendant_name' => 'required'
        ]);
        $result = $this->handleTransaction(function () use ($request) {
            $member = Member::create([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'sex' => $request->sex,
                'status' => $request->status,
                'birthdate' => $request->birthdate,
            ]);
            if($member){
                FamilyMember::create([
                    'type_id' => 4,
                    'member_id' => $member->id,
                    'family_id' => FamilyMember::where('member_id',$request->id)->value('family_id'),
                ]);
                
                AppointmentMaternalDelivery::create([
                    'delivery_id' => $request->delivery_id,
                    'outcome_id' => $request->outcome_id,
                    'weight_id' => $request->weight_id,
                    'facility_id' => $request->facility_id,
                    'attendant_id' => $request->attendant_id,
                    'attendant_name' => $request->attendant_name,
                    'remarks' => $request->remarks,
                    'delivery_at' => $request->birthdate,
                    'member_id' => $member->id,
                    'am_id' => $request->id
                ]);
            }

            return [
                'data' => [],
                'message' => 'Delivery creation was successful!', 
                'info' => "You've successfully added delivery."
            ];
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function checkup(Request $request){
        $request->validate([
            'type_id' => 'required',
            'subtype_id' => 'required_if:type_id.value:38,39,42,43',
            'count' => 'required_if:type_id.value,38,39',
            'value' => 'required_if:type_id.value,39,42,43',
            'date_at' => 'required',
            'remarks' => 'required'
        ]);

        $result = $this->handleTransaction(function () use ($request) {
            $data = new AppointmentMaternalCheckup;
            $data->remarks = $request->remarks;
            $data->value = $request->value;
            $data->count = $request->count;
            $data->subtype_id = $request->subtype_id;
            $data->type_id = $request->type_id['value'];
            $data->date_at = $request->date_at;
            $data->am_id = $request->id;
            $data->additional_info = json_encode($request->additional_info);
            if($data->save()){
                $status = AppointmentMaternal::where('id',$request->id)->first();
                $status->appointment()->update(['status_id' => 34]);
            }
            return [
                'data' => [],
                'message' => 'Delivery creation was successful!', 
                'info' => "You've successfully added delivery."
            ];
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function checkupf(Request $request){
        $request->validate([
            'type_id' => 'required',
            'count' => 'required_if:type_id.value,38,39',
            'date_at' => 'required'
        ]);

        $result = $this->handleTransaction(function () use ($request) {
            $data = new AppointmentFamilyCheckup;
            $data->remarks = $request->remarks;
            $data->count = $request->count;
            $data->type_id = $request->type_id['value'];
            $data->date_at = $request->date_at;
            $data->af_id = $request->id;
            if($data->save()){
                $status = AppointmentFamily::where('id',$request->id)->first();
                $status->appointment()->update(['status_id' => 34]);
            }
            return [
                'data' => [],
                'message' => 'Checkup creation was successful!', 
                'info' => "You've successfully added delivery."
            ];
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    private function lists($request){
        $data = Appointment::query()
        ->with('patient.member','service','status')
        ->with('family.reason','family.type','family.method')
        ->with('maternal.checkups','maternal.deliveries')
        ->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('patient',function ($query) use ($keyword) {
                $query->whereHas('member',function ($query) use ($keyword) {
                    $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', "%{$keyword}%")
                    ->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', "%{$keyword}%");
                });
            });
        })
        ->when($request->service, function ($query, $service) {
           $query->where('service_id',$service);
        })
        ->when($request->status, function ($query, $status) {
            $query->where('status_id',$status);
         })
        ->orderBy('created_at','DESC')
        ->paginate($request->count);

        return AppointmentResource::collection($data);
    }

    private function dropdowns($data){
        return ListDropdown::where('classification',$data)->where('is_active',1)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name,
                'type' => $item->type,
            ];
        });
    }

    private function result($appointment){
        if($appointment->service_id == 8){
            $id = $appointment->maternal->id;
            return [
                '1' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                        $query->where('name', 'Prenatal Check-ups');
                    })->where('count','1st Trimester')->where('am_id', $id)->get(),
                '2' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Prenatal Check-ups');
                })->where('count','2nd Trimester')->where('am_id', $id)->get(),
                '3' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Prenatal Check-ups');
                })->where('count','3rd Trimester')->where('am_id', $id)->get(),
                '4' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Immunization Status');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                })
                ->where('count','Td1/TT1')->where('am_id', $id)->get(),
                '5' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Immunization Status');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                })
                ->where('count','Td2/TT2')->where('am_id', $id)->get(),
                '6' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Immunization Status');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                })
                ->where('count','Td3/TT3')->where('am_id', $id)->get(),
                '7' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Immunization Status');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                })
                ->where('count','Td4/TT4')->where('am_id', $id)->get(),
                '8' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Immunization Status');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Tetanus Diphteria / Tetanus Toxoid');
                })
                ->where('count','Td5/TT5')->where('am_id', $id)->get(),
                '9' => false,
                '10' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Iron Sulfate with Folic Acid');
                })
                ->where('count','1st Trimester')->where('am_id', $id)->get(),
            '11' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Iron Sulfate with Folic Acid');
                })
                ->where('count','2nd Trimester')->where('am_id', $id)->get(),
                '12' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Iron Sulfate with Folic Acid');
                })
                ->where('count','3rd Trimester')->where('am_id', $id)->get(),
                '13' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Iron Sulfate with Folic Acid');
                })
                ->where('count','4th Trimester')->where('am_id', $id)->get(),
                '14' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Calcium Carbonate');
                })
                ->where('count','2nd Trimester')->where('am_id', $id)->get(),
                '15' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Calcium Carbonate');
                })
                ->where('count','3rd Trimester')->where('am_id', $id)->get(),
                '16' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Calcium Carbonate');
                })
                ->where('count','4th Trimester')->where('am_id', $id)->get(),
                '17' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Micronutrient Supplementation');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Iodine Capsules');
                })
                ->where('count','1st Trimester')->where('am_id', $id)->get(),
                '18' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Nutritional Assessment');
                })
                ->where('am_id', $id)->get(),
                '19' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Deworming Tablet');
                })
                ->where('am_id', $id)->get(),
                '20' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Infectious Disease Surveillance');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Screening');
                })
                ->where('am_id', $id)->get(),
                '21' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Infectious Disease Surveillance');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Hepatitis B (Result of HbsAg)');
                })
                ->where('am_id', $id)->get(),
                '22' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Infectious Disease Surveillance');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'HIV (Date of Screening)');
                })
                ->where('am_id', $id)->get(),
                '23' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Laboratory Screening');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'Gestational Diabetes');
                })
                ->where('am_id', $id)->get(),
                '24' => AppointmentMaternalCheckup::with('type','subtype')->whereHas('type', function ($query) {
                    $query->where('name', 'Laboratory Screening');
                })
                ->whereHas('subtype', function ($query) {
                    $query->where('name', 'CBC/Hgb & Hct Count');
                })
                ->where('am_id', $id)->get(),
            ];
        }else if($appointment->service_id == 9){
            $id = $appointment->family->id;
            return [
                '1' => AppointmentFamilyVisit::whereMonth('visited_at',1)->where('af_id', $id)->exists(),
                '2' => AppointmentFamilyVisit::whereMonth('visited_at',2)->where('af_id', $id)->exists(),
                '3' => AppointmentFamilyVisit::whereMonth('visited_at',3)->where('af_id', $id)->exists(),
                '4' => AppointmentFamilyVisit::whereMonth('visited_at',4)->where('af_id', $id)->exists(),
                '5' => AppointmentFamilyVisit::whereMonth('visited_at',5)->where('af_id', $id)->exists(),
                '6' => AppointmentFamilyVisit::whereMonth('visited_at',6)->where('af_id', $id)->exists(),
                '7' => AppointmentFamilyVisit::whereMonth('visited_at',7)->where('af_id', $id)->exists(),
                '8' => AppointmentFamilyVisit::whereMonth('visited_at',8)->where('af_id', $id)->exists(),
                '9' => AppointmentFamilyVisit::whereMonth('visited_at',9)->where('af_id', $id)->exists(),
                '10' => AppointmentFamilyVisit::whereMonth('visited_at',10)->where('af_id', $id)->exists(),
                '11' => AppointmentFamilyVisit::whereMonth('visited_at',11)->where('af_id', $id)->exists(),
                '12' => AppointmentFamilyVisit::whereMonth('visited_at',12)->where('af_id', $id)->exists(),
                '13' => AppointmentFamilyCheckup::with('type')->where('count','1st dose given')->where('af_id', $id)->first(),
                '14' => AppointmentFamilyCheckup::with('type')->where('count','2nd dose given')->where('af_id', $id)->first(),
                '15' => AppointmentFamilyCheckup::with('type')->where('count','3rd dose given')->where('af_id', $id)->first(),
                '16' => AppointmentFamily::with('reason')->where('is_dropout',1)->where('id', $id)->first(),
            ];
        }
    }

    public function show($code){
        $appointment = new AppointmentResource(Appointment::with('patient.member','service','status')
        ->with('family.reason','family.type','family.method','family.visits')
        ->with('maternal.checkups.type','maternal.checkups.subtype')
        ->with('maternal.deliveries.outcome','maternal.deliveries.facility','maternal.deliveries.attendant','maternal.deliveries.weight','maternal.deliveries.delivery','maternal.deliveries.member')
        ->where('id',$code)->first());
        return inertia('Appointments/View',[
            'a' => $appointment,
            'dropdowns' => [
                'families' => [
                    'reasons' => $this->dropdowns('Reason'),
                    'types' => $this->dropdowns('FamilyType'),
                ],
                'maternals' => [
                    'lists' => $this->dropdowns('Maternal'),
                    'outcomes' => $this->dropdowns('Outcome'),
                    'facilities' => $this->dropdowns('Facility'),
                    'deliveries' => $this->dropdowns('Delivery'),
                    'attendants' => $this->dropdowns('Attendant'),
                    'weights' => $this->dropdowns('Weight'),
                    'maternals' => $this->dropdowns('Maternal'),
                    'submaternals' => $this->dropdowns('Submaternal')
                ],
            ],
            'results' => $this->result($appointment)
        ]);
    }
}
