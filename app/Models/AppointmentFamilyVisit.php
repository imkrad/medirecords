<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentFamilyVisit extends Model
{
    use HasFactory;

    public function af()
    {
        return $this->belongsTo('App\Models\AppointmentFamily', 'af_id', 'id');
    }

    public function getScheduledAtAttribute($value)
    {
        return date('F d, Y', strtotime($value));
    }

    public function getVisitedAtAttribute($value)
    {
        return ($value) ? date('F d, Y', strtotime($value)) : null;
    }
}
