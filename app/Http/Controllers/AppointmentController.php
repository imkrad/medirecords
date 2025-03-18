<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\AppointmentFamily;
use App\Models\AppointmentFamilyVisit;
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
                        'source' => $request->source
                    ]);
                }else if($request->service_id == 8){
                    $maternal = $data->maternal()->create([
                        'lmp_at' => $request->lmp_at,
                        'edc_at' => $request->edc_at,
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
            'remarks' => 'required'
        ]);

        $data = AppointmentFamilyVisit::with('af')->where('id',$request->af_id)->first();
        $data->visited_at = $request->visited_at;
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

    private function lists($request){
        $data = Appointment::query()
        ->with('patient.member','service','status')
        ->with('family.reason','family.type','family.method')
        ->with('maternal.checkups','maternal.delivery')
        ->when($request->keyword, function ($query, $keyword) {
           
        })
        ->orderBy('created_at','DESC')
        ->paginate($request->count);

        return AppointmentResource::collection($data);
    }

    private function dropdowns($data){
        return ListDropdown::where('classification',$data)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });
    }

    public function show($code){
        return inertia('Appointments/View',[
            'a' => new AppointmentResource(Appointment::with('patient.member','service','status')
            ->with('family.reason','family.type','family.method','family.visits')
            ->with('maternal.checkups','maternal.delivery')->where('id',$code)->first()),
            'dropdowns' => [
                'families' => [
                    'reasons' => $this->dropdowns('Reason')
                ],
                'maternals' => [
                    'lists' => $this->dropdowns('Maternal'),
                    'outcomes' => $this->dropdowns('Outcome'),
                    'facilities' => $this->dropdowns('Facility'),
                    'deliveries' => $this->dropdowns('Delivery'),
                    'attendants' => $this->dropdowns('Attendant'),
                    'weights' => $this->dropdowns('Weight')
                ],
            ]
        ]);
    }
}
