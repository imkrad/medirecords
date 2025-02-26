<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Member;
use App\Models\FamilyMember;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Resources\PatientResource;
use App\Traits\HandlesTransaction;

class PatientController extends Controller
{
    use HandlesTransaction;

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
            ->with('member.families.family.members')
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
        $result = $this->handleTransaction(function () use ($request) {
            if($request->code){
                $family = Family::where('code',$request->code)->first();
            }else{
                $family = new Family;
                $family->code = date('Y').'-'.str_pad((Family::count()+1), 5, '0', STR_PAD_LEFT);
                $family->name = $request->lastname;
                $family->save();
            }
           
            if($family){
                $member = Member::create([
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'sex' => $request->sex,
                    'status' => $request->status,
                    'birthdate' => $request->birthdate,
                ]);
                if($member){
                    $patient = Patient::create([
                        'code' => 'PTL-'.date('Y').'-'.str_pad((Patient::count()+1), 5, '0', STR_PAD_LEFT),
                        'email' => $request->email,
                        'cellphone' => $request->cellphone,
                        'homephone' => $request->homephone,
                        'address' => $request->address,
                        'fullname' => $request->fullname,
                        'contact_no' => $request->contact_no,
                        'relationship' => $request->relationship,
                        'member_id' => $member->id
                    ]);

                    if($patient){
                        if($request->code == null){
                            if($request->status == 'Single'){
                                FamilyMember::create([
                                    'type_id' => 4,
                                    'member_id' => $member->id,
                                    'family_id' => $family->id,
                                ]);
                                $mother = Member::create([
                                    'firstname' => $request->mother['firstname'],
                                    'middlename' => $request->mother['middlename'],
                                    'lastname' => $request->mother['lastname'],
                                    'sex' => $request->mother['sex'],
                                    'status' => $request->mother['status'],
                                ]);
                                if($mother){
                                    FamilyMember::create([
                                        'type_id' => 2,
                                        'member_id' => $mother->id,
                                        'family_id' => $family->id,
                                    ]);
                                }
                                $father = Member::create([
                                    'firstname' => $request->father['firstname'],
                                    'middlename' => $request->father['middlename'],
                                    'lastname' => $request->father['lastname'],
                                    'sex' => $request->father['sex'],
                                    'status' => $request->father['status'],
                                ]);
                                if($father){
                                    FamilyMember::create([
                                        'type_id' => 3,
                                        'member_id' => $father->id,
                                        'family_id' => $family->id,
                                    ]);
                                }
                            }else if($request->status == 'Married'){
                                if($request->sex == 'Male'){
                                    FamilyMember::create([
                                        'type_id' => 3,
                                        'member_id' => $member->id,
                                        'family_id' => $family->id,
                                    ]);
                                    $mother = Member::create([
                                        'firstname' => $request->mother['firstname'],
                                        'middlename' => $request->mother['middlename'],
                                        'lastname' => $request->mother['lastname'],
                                        'sex' => 'Female',
                                        'status' => $request->mother['status'],
                                    ]);
                                    if($mother){
                                        FamilyMember::create([
                                            'type_id' => 2,
                                            'member_id' => $mother->id,
                                            'family_id' => $family->id,
                                        ]);
                                    }
                                }else{
                                    FamilyMember::create([
                                        'type_id' => 2,
                                        'member_id' => $member->id,
                                        'family_id' => $family->id,
                                    ]);
                                    $father = Member::create([
                                        'firstname' => $request->mother['firstname'],
                                        'middlename' => $request->mother['middlename'],
                                        'lastname' => $request->mother['lastname'],
                                        'sex' => 'Male',
                                        'status' => $request->mother['status'],
                                    ]);
                                    if($father){
                                        FamilyMember::create([
                                            'type_id' => 3,
                                            'member_id' => $father->id,
                                            'family_id' => $family->id,
                                        ]);
                                    }
                                }
                            }
                        }else{
                            FamilyMember::create([
                                'type_id' => 4,
                                'member_id' => $member->id,
                                'family_id' => $family->id,
                            ]);
                        }
                    }
                }
            }
            return [
                'data' => [],
                'message' => 'Patient creation was successful!', 
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

    public function show($code){
        return inertia('Patients/View',[
            'p' => new PatientResource(Patient::with('member.families.family.members.member','member.families.family.members.type')->where('code',$code)->first()),
        ]);
    }
}
