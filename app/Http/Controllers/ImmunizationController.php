<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use Illuminate\Http\Request;

class ImmunizationController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->lists($request);
            break;
            default: 
                return inertia('Immunizations/Index',[
                    'immunizations' => Immunization::with('vaccine')->where('is_active',1)->get()
                ]);
        }
    }
}
