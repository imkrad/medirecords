<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
       'patient_id','service_id','is_nhts','age','registration_at','status_id','code'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'status_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'service_id', 'id');
    }

    public function family()
    {
        return $this->hasOne('App\Models\AppointmentFamily', 'appointment_id');
    }

    public function maternal()
    {
        return $this->hasOne('App\Models\AppointmentMaternal', 'appointment_id');
    }

    public function immunization()
    {
        return $this->hasOne('App\Models\AppointmentImmunization', 'appointment_id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('F d, Y g:i a', strtotime($value));
    }

    public function getRegistrationAtAttribute($value)
    {
        return date('F d, Y', strtotime($value));
    }
}
