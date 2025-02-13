<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Resources\PatientResource;

class PatientController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->lists($request);
            break;
            default: 
                return inertia('Patients/Index');
        }
    }

    private function lists($request){
        $data = Patient::query()
            ->with('contact')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', "%{$keyword}%")
                ->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', "%{$keyword}%");
            })
            ->orderBy('created_at','DESC')
            ->paginate($request->count);

        return PatientResource::collection($data);
    }

    public function create(Request $request){
        return inertia('Patients/Create');
    }

    public function store(Request $request){
        $data = Patient::create([
            'code' => 'PTL-'.date('Y').'-'.str_pad((Patient::count()+1), 5, '0', STR_PAD_LEFT),
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'sex' => $request->sex,
            'status' => $request->status,
            'birthdate' => $request->birthdate,
        ]);
        $data->contact()->create([
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'homephone' => $request->homephone,
            'address' => $request->address,
            'fullname' => $request->fullname,
            'contact_no' => $request->contact_no,
            'relationship' => $request->relationship,
        ]);

        return back()->with([
            'data' => $data,
            'message' => 'Patient was added.',
            'info' => 'You\'ve successfully created new user.',
            'status' => true,
        ]);
    }

    public function show($code){
        return inertia('Patients/View',[
            'p' => new PatientResource(Patient::with('contact')->where('code',$code)->first()),
        ]);
    }
}
