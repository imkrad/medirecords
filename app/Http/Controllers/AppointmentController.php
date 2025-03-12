<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
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
                    ]
                ]);
        }
    }

    public function store(AppointmentRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            $data = Appointment::create([
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

    private function lists($request){
        $data = Appointment::query()
        ->with('patient.member','service','status')
        ->with('family.reason','family.type','family.method')
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
}
