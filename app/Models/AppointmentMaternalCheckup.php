<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentMaternalCheckup extends Model
{
    use HasFactory;

    protected $fillable = [
        'remarks','value','count','type_id','subtype_id','am_id','date_at'
    ];

    public function am()
    {
        return $this->belongsTo('App\Models\AppointmentMaternal', 'am_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'type_id', 'id');
    }

    public function subtype()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'subtype_id', 'id');
    }

    public function getDateAtAttribute($value)
    {
        return date('F d, Y', strtotime($value));
    }
}
