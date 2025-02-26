<?php

namespace App\Http\Controllers;

use App\Models\ListDropdown;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->lists($request);
            break;
            default: 
                return inertia('Appointments/Index',[
                    'services' => ListDropdown::where('classification','Service')->get()->map(function ($item) {
                        return [
                            'value' => $item->id,
                            'name' => $item->name
                        ];
                    })
                ]);
        }
    }
}
