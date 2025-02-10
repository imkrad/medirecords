<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'firstname', 
        'lastname', 
        'middlename',
        'birthdate',
        'sex',
        'status',
        'avatar'
    ];

    public function contact()
    {
        return $this->hasOne('App\Models\PatientContact', 'patient_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function getBirthdateAttribute($value)
    {

        return ($value) ? date('F d, Y', strtotime($value)) : null;
    }

}
