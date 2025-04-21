<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentImmunizationList extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_at','range_id','vaccine_id','ai_id','remarks'
    ];

    public function range()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'range_id', 'id');
    }

    public function vaccine()
    {
        return $this->belongsTo('App\Models\Immunization', 'vaccine_id', 'id');
    }
}
