<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','name'
    ];

    public function members()
    {
        return $this->hasMany('App\Models\FamilyMember', 'family_id');
    }
}
