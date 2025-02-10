<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TclController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->lists($request);
            break;
            default: 
                return inertia('Tcl/Index');
        }
    }
}
