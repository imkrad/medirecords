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
            'avatar' => ($this->avatar === 'avatar.jpg') ? '/images/avatars/'.$this->avatar : '/storage/'.$this->avatar,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
            'sex' => $this->sex,
            'status' => $this->status,
            'birthdate' => $this->birthdate,
            'homephone' => $this->contact->homephone,
            'cellphone' => $this->contact->cellphone,
            'email' => $this->contact->email,
            'address' => $this->contact->address,
            'relationship' => $this->contact->relationship,
            'contact_no' => $this->contact->contact_no,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
