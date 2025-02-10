<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'homephone',
        'cellphone',
        'address',
        'fullname',
        'contact_no',
        'relationship',
        'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }
}
