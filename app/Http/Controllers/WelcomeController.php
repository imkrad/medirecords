<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        return inertia('Auth/Login');
    }

    public function search(Request $request){
        $option = $request->option;
        switch($option){
            case 'patient':
                return $this->patient($request->code);
            break;
        }
    }

    private function patient($code){
        $data = Patient::with('member.families.type')
        ->when($code, function ($query, $keyword) {
            $query->whereHas('member',function ($query) use ($keyword) {
                $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', "%{$keyword}%")
                ->orWhere(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', "%{$keyword}%");
            });
        })->take(5)->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->member->firstname.' '. $item->member->lastname.' ('.$item->member->families[0]->type->name.')',
                'birthdate' => $item->member->birthdate,
                'type' => $item->member->families[0]->type->name
            ];
        });
        return $data;
    }
}
