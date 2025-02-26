<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class FamilyController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->lists($request);
            break;
            default: 
                return inertia('Families/Index');
        }
    }

    private function lists($request){
        $data = DefaultResource::collection(
            Family::query()
            ->with('members.member','members.type')
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('code', 'LIKE', "%{$keyword}%")->orWhere('name', 'LIKE', "%{$keyword}%");
            })
            ->orderBy('created_at','DESC')
            ->paginate($request->count)
        );
        return $data;
    }
}
