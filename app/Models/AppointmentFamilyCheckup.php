<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentFamilyCheckup extends Model
{
    use HasFactory;

    protected $fillable = [
        'remarks','count','date_at','type_id','af_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'type_id', 'id');
    }

    public function getDateAtAttribute($value)
    {
        return date('F d, Y', strtotime($value));
    }
}
