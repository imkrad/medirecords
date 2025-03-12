<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'source','dropout_at','is_dropdout','reason_id','method_id','type_id','appointment_id'
     ];
 
     public function reason()
     {
         return $this->belongsTo('App\Models\ListDropdown', 'reason_id', 'id');
     }

     public function type()
     {
         return $this->belongsTo('App\Models\ListDropdown', 'type_id', 'id');
     }
 
     public function method()
     {
         return $this->belongsTo('App\Models\ListDropdown', 'method_id', 'id');
     }

     public function appointment()
     {
         return $this->belongsTo('App\Models\Appointment', 'appointment_id', 'id');
     }
 
     public function visits()
     {
         return $this->hasMany('App\Models\AppointmentFamilyVisit', 'appointment_id');
     }
 
     public function getUpdatedAtAttribute($value)
     {
         return date('M d, Y g:i a', strtotime($value));
     }
 
     public function getCreatedAtAttribute($value)
     {
         return date('F d, Y g:i a', strtotime($value));
     }
}
