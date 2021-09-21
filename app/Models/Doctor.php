<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pet;

class Doctor extends Model
{
    use HasFactory;

    public function doctorPets()
    {
        return $this->hasMany(Pet::class, 'doctor_id', 'id');
        //return $this->hasMany('App\Models\Pet', 'reservoir_id', 'id');
    }
}