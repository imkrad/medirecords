<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentMaternalDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id','outcome_id','facility_id','weight_id','attendant_id','attendant_name','member_id','am_id','remarks','delivery_at'
    ];

    public function delivery()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'delivery_id', 'id');
    }

    public function outcome()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'outcome_id', 'id');
    }

    public function facility()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'facility_id', 'id');
    }

    public function weight()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'weight_id', 'id');
    }

    public function attendant()
    {
        return $this->belongsTo('App\Models\ListDropdown', 'attendant_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id', 'id');
    }

    public function maternal()
    {
        return $this->belongsTo('App\Models\AppointmentMaternal', 'am_id', 'id');
    }
}
