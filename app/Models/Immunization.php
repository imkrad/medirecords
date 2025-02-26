<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    use HasFactory;

    public function vaccine()
    {
        return $this->belongsTo('App\Models\Vaccine', 'vaccine_id', 'id');
    }
}
