<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pet;

class Owner extends Model
{
    use HasFactory;


    public function ownerPets()
    {
        return $this->hasMany(Pet::class, 'owner_id', 'id');
        //return $this->hasMany('App\Models\Pet', 'owner_id', 'id');
    }
}