<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentImmunizationNsa extends Model
{
    use HasFactory;

    
    public function range()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'range_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ListStatus', 'status_id', 'id');
    }
}
