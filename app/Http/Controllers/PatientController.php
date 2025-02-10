<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

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

    public function create(Request $request){
        return inertia('Patients/Create');
    }

    public function store(UserRequest $request){
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
            'message' => 'User was created.',
            'info' => 'You\'ve successfully created new user.',
            'status' => true,
        ]);
    }
}
