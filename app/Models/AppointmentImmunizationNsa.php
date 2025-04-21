<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentImmunizationNsa extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight','height','range_id','date_at'
    ];

    
    public function range()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'range_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'status_id', 'id');
    }
}
