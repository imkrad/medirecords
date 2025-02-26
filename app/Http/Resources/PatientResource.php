<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'avatar' => ($this->member->avatar === 'avatar.jpg') ? '/images/avatars/'.$this->member->avatar : '/storage/'.$this->member->avatar,
            'firstname' => $this->member->firstname,
            'lastname' => $this->member->lastname,
            'middlename' => $this->member->middlename,
            'sex' => $this->member->sex,
            'status' => $this->member->status,
            'birthdate' => $this->member->birthdate,
            'homephone' => $this->homephone,
            'cellphone' => $this->cellphone,
            'email' => $this->email,
            'address' => $this->address,
            'relationship' => $this->relationship,
            'contact_no' => $this->contact_no,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'families' => FamilyResource::collection($this->member->families)
        ];
    }
}
