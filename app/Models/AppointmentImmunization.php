<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentImmunization extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight_id','height','weight','appointment_id','was_breastfeed','cpab_id'
    ];

    public function nsas()
    {
        return $this->hasMany('App\Models\AppointmentImmunizationNsa', 'ai_id');
    }

    public function lists()
    {
        return $this->hasMany('App\Models\AppointmentImmunizationList', 'ai_id');
    }
}
