<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentMaternal extends Model
{
    use HasFactory;

    protected $fillable = [
        'lmp_at','edc_at','height','weight','appointment_id'
    ];
    
    public function checkups()
    {
        return $this->hasMany('App\Models\AppointmentMaternalCheckup', 'am_id');
    }

    public function deliveries()
    {
        return $this->hasMany('App\Models\AppointmentMaternalDelivery', 'am_id');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment', 'appointment_id', 'id');
    }
 
}
