<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Http\Resources\DefaultResource;

class MemberController extends Controller
{
    public function members(Request $request){
        $keyword = $request->keyword;
        $data = FamilyMember::with('member','family','type')
        ->whereHas('member',function ($query) use ($keyword) {
            $query->whereRaw("CONCAT(firstname, ' ', middlename, ' ', lastname) LIKE ?", ["%{$keyword}%"])
            ->orWhereRaw("CONCAT(lastname, ' ', middlename, ' ', firstname) LIKE ?", ["%{$keyword}%"])
            ->orWhereRaw("CONCAT(middlename, ' ', firstname, ' ', lastname) LIKE ?", ["%{$keyword}%"])
            ->orWhereRaw("CONCAT(lastname, ' ', firstname, ' ', middlename) LIKE ?", ["%{$keyword}%"])
            ->orWhereRaw("CONCAT(middlename, ' ', lastname, ' ', firstname) LIKE ?", ["%{$keyword}%"]);
        })
        ->orderBy('type_id','asc')
        ->limit(5)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'type' => $item->type->name,
                'code' => $item->family->code,
                'name' => $item->member->firstname.' '.$item->member->middlename.' '.$item->member->lastname
            ];
        });
        return $data;
    }
}
